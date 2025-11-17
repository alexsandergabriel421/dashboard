<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with('produto')->get();
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('vendas.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        Venda::create([
            'idProduto'  => $request->idProduto,
            'quantidade' => $request->quantidade,
            'valorTotal' => $request->valorTotal,
            'dataVenda'  => $request->dataVenda ?? now(),
        ]);

        return redirect()->route('vendas.index');
    }

    public function exportCsv()
    {
        $vendas = Venda::with('produto')->get();

        $bom = "\xEF\xBB\xBF";
        $csv  = $bom;
        $csv .= "ID;Produto;Quantidade;Total;Data\n";

        foreach ($vendas as $v) {

            if ($v->dataVenda) {
                $data = \Carbon\Carbon::parse($v->dataVenda)->format('d/m/Y');
                $data = '="' . $data . '"';
            } else {
                $data = '"---"';
            }

            $valor = number_format($v->valorTotal, 2, '.', '');

            $csv .= implode(';', [
                $v->id,
                $v->produto->nomeProduto ?? 'Produto removido',
                $v->quantidade,
                $valor,
                $data
            ]) . "\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename=vendas.csv');
    }

    public function exportPdf()
    {
        $vendas = Venda::with('produto')->get();

        $pdf = Pdf::loadView('exports.vendas_pdf', compact('vendas'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('vendas.pdf');
    }
}
