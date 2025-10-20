<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * Função genérica para exportar qualquer tabela em CSV (UTF-8 com BOM)
     */
    private function exportToCsv(string $filename, array $columns, array $data)
    {
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control'       => 'no-store, no-cache, must-revalidate',
        ];

        return new StreamedResponse(function () use ($columns, $data) {
            $file = fopen('php://output', 'w');

            // BOM UTF-8
            fwrite($file, "\xEF\xBB\xBF");

            // Cabeçalho
            fputcsv($file, $columns, ';');

            // Linhas
            foreach ($data as $row) {
                $row = array_map(function ($value) {
                    if (is_null($value)) return '';
                    if (is_string($value)) {
                        $value = str_replace(';', ',', $value);
                        $value = trim($value);
                    }
                    return $value;
                }, $row);

                fputcsv($file, $row, ';');
            }

            fclose($file);
        }, 200, $headers);
    }

    /**
     * Exportar Funcionários do banco
     */
    public function funcionarios()
    {
        $dados = DB::table('tbFuncionario')->get();
        $array = $dados->map(fn($d) => [$d->idFuncionario, $d->nomeFuncionario, $d->dateNascFuncionario])->toArray();

        return $this->exportToCsv('funcionarios.csv', ['ID', 'Nome', 'Nascimento'], $array);
    }

    /**
     * Exportar Produtos do banco
     */
    public function produtos()
    {
        $dados = DB::table('tbProduto')->get();
        $array = $dados->map(fn($d) => [
            $d->idProduto,
            $d->nomeProduto,
            $d->categoriaProduto,
            number_format($d->precoProduto,2,',','.')
        ])->toArray();

        return $this->exportToCsv('produtos.csv', ['ID', 'Produto', 'Categoria', 'Preço (R$)'], $array);
    }

    /**
     * Exportar Vendas do banco
     */
    public function vendas()
    {
        $dados = DB::table('tbVendas')->get();
        $array = $dados->map(fn($d) => [
            $d->idVenda,
            $d->nomeProduto,
            $d->quantidade,
            number_format($d->valorTotal,2,',','.')
        ])->toArray();

        return $this->exportToCsv('vendas.csv', ['ID', 'Produto', 'Quantidade', 'Valor Total (R$)'], $array);
    }
}
