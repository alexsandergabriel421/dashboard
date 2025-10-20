<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    private function exportToCsv(string $filename, array $columns, array $rows): StreamedResponse
    {
        $headers = [
            'Content-Type'        => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Cache-Control'       => 'no-store, no-cache, must-revalidate',
        ];

        return new StreamedResponse(function() use ($columns, $rows) {
            $file = fopen('php://output', 'w');

            // BOM UTF-8 (resolve acentos no Excel 16)
            fwrite($file, "\xEF\xBB\xBF");

            // Separador para Excel PT-BR
            fwrite($file, "sep=;\n");

            // Cabeçalho
            fputcsv($file, $columns, ';');

            // Linhas
            foreach ($rows as $row) {
                $row = array_map(function($v) {
                    if (is_null($v)) return '';
                    if (is_numeric($v)) return $v;
                    return str_replace(';', ',', trim((string)$v));
                }, $row);

                fputcsv($file, $row, ';');
            }

            fclose($file);
        }, 200, $headers);
    }

    public function funcionarios()
    {
        $dados = DB::select('SELECT * FROM tbFuncionario');
        $rows = array_map(fn($d) => [
            $d->idFuncionario,
            $d->nomeFuncionario,
            $d->dateNascFuncionario
        ], $dados);

        return $this->exportToCsv('funcionarios.csv', ['ID', 'Nome', 'Nascimento'], $rows);
    }

    public function produtos()
    {
        $dados = DB::select('SELECT * FROM tbProduto');
        $rows = array_map(fn($d) => [
            $d->idProduto,
            $d->nomeProduto,
            $d->categoriaProduto,
            number_format($d->precoProduto, 2, ',', '.')
        ], $dados);

        return $this->exportToCsv('produtos.csv', ['ID', 'Produto', 'Categoria', 'Preço (R$)'], $rows);
    }

    public function vendas()
    {
        $dados = DB::select('SELECT * FROM tbVendas');
        $rows = array_map(fn($d) => [
            $d->idVenda,
            $d->nomeProduto,
            $d->quantidade,
            number_format($d->valorTotal, 2, ',', '.')
        ], $dados);

        return $this->exportToCsv('vendas.csv', ['ID', 'Produto', 'Quantidade', 'Valor Total (R$)'], $rows);
    }
}
