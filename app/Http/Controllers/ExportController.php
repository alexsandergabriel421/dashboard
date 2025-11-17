<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    // CSV FUNCIONÁRIOS (stream para memória reduzida)
    public function funcionarios()
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="funcionarios.csv"',
        ];

        $callback = function () {
            $out = fopen('php://output', 'w');
            // BOM para Excel interpretar UTF-8 corretamente
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            // Cabeçalho CSV
            fputcsv($out, ['ID', 'Nome', 'Cargo', 'Salário'], ';');

            $funcionarios = DB::table('tbfuncionario')->orderBy('id')->cursor();
            foreach ($funcionarios as $f) {
                // usar os nomes reais do banco
                fputcsv($out, [
                    $f->id,
                    $f->nomeFuncionario,
                    $f->cargoFuncionario,
                    $f->salarioFuncionario
                ], ';');
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    // CSV PRODUTOS
    public function produtos()
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="produtos.csv"',
        ];

        $callback = function () {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, ['ID', 'Produto', 'Preço', 'Categoria'], ';');

            $produtos = DB::table('tbproduto')->orderBy('id')->cursor();
            foreach ($produtos as $p) {
                fputcsv($out, [
                    $p->id,
                    $p->nomeProduto,
                    $p->precoProduto,
                    $p->categoria
                ], ';');
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    // CSV VENDAS (com nome do produto via join)
    public function vendas()
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="vendas.csv"',
        ];

        $callback = function () {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($out, ['ID', 'Produto (id)', 'Nome do Produto', 'Quantidade', 'Total', 'Data'], ';');

            // traz vendas com nome do produto (join)
            $vendas = DB::table('tbvendas')
                ->leftJoin('tbproduto', 'tbvendas.idProduto', '=', 'tbproduto.id')
                ->select('tbvendas.*', 'tbproduto.nomeProduto as nomeProduto')
                ->orderBy('tbvendas.id')
                ->cursor();

            foreach ($vendas as $v) {
                fputcsv($out, [
                    $v->id,
                    $v->idProduto,
                    $v->nomeProduto ?? '',
                    $v->quantidade,
                    $v->valorTotal,
                    $v->dataVenda,
                ], ';');
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    // --------------------------
    // PDF
    // --------------------------

    public function funcionariosPdf()
    {
        $funcionarios = DB::table('tbfuncionario')->orderBy('id')->get();
        // certifique-se que a view pdf.funcionarios use $f->id, $f->nomeFuncionario etc
        $pdf = Pdf::loadView('pdf.funcionarios', compact('funcionarios'));
        return $pdf->download('funcionarios.pdf');
    }

    public function produtosPdf()
    {
        $produtos = DB::table('tbproduto')->orderBy('id')->get();
        $pdf = Pdf::loadView('pdf.produtos', compact('produtos'));
        return $pdf->download('produtos.pdf');
    }

    public function vendasPdf()
    {
        // traga o nome do produto junto para ser mais legível no PDF
        $vendas = DB::table('tbvendas')
            ->leftJoin('tbproduto', 'tbvendas.idProduto', '=', 'tbproduto.id')
            ->select('tbvendas.*', 'tbproduto.nomeProduto as nomeProduto')
            ->orderBy('tbvendas.id')
            ->get();

        $pdf = Pdf::loadView('pdf.vendas', compact('vendas'));
        return $pdf->download('vendas.pdf');
    }
}
