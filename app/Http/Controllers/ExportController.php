<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * Função genérica para exportar qualquer tabela em CSV
     * Compatível com Excel (Brasil e internacional)
     */
    private function exportToCsv(string $filename, array $columns, callable $dataCallback)
    {
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control'       => 'no-store, no-cache, must-revalidate',
        ];

        return new StreamedResponse(function () use ($columns, $dataCallback) {
            $file = fopen('php://output', 'w');

            // BOM UTF-8 + indicação de separador (Excel PT-BR reconhece automaticamente)
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF) . "sep=;\n");

            // Cabeçalho
            fputcsv($file, $columns, ';');

            // Dados
            foreach ($dataCallback() as $row) {
                fputcsv($file, $row, ';');
            }

            fclose($file);
        }, 200, $headers);
    }

    /**
     * Exportar Funcionários
     */
    public function funcionarios()
    {
        $dados = DB::select('SELECT * FROM tbFuncionario');

        return $this->exportToCsv(
            'funcionarios.csv',
            ['ID', 'Nome', 'Nascimento'],
            function () use ($dados) {
                return array_map(fn($d) => [
                    $d->idFuncionario,
                    $d->nomeFuncionario,
                    $d->dateNascFuncionario,
                ], $dados);
            }
        );
    }

    /**
     * Exportar Produtos
     */
    public function produtos()
    {
        $dados = DB::select('SELECT * FROM tbProduto');

        return $this->exportToCsv(
            'produtos.csv',
            ['ID', 'Produto', 'Categoria', 'Preço (R$)'],
            function () use ($dados) {
                return array_map(fn($d) => [
                    $d->idProduto,
                    $d->nomeProduto,
                    $d->categoriaProduto,
                    number_format($d->precoProduto, 2, ',', '.'),
                ], $dados);
            }
        );
    }

    /**
     * Exportar Vendas
     */
    public function vendas()
    {
        $dados = DB::select('SELECT * FROM tbVendas');

        return $this->exportToCsv(
            'vendas.csv',
            ['ID', 'Produto', 'Quantidade', 'Valor Total (R$)'],
            function () use ($dados) {
                return array_map(fn($d) => [
                    $d->idVenda,
                    $d->nomeProduto,
                    $d->quantidade,
                    number_format($d->valorTotal, 2, ',', '.'),
                ], $dados);
            }
        );
    }
}
