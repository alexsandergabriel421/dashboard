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
        $request->validate([
            'produto_id' => 'required|exists:tbproduto,id',
            'quantidade' => 'required|integer|min:1',
            'valorTotal' => 'required|numeric|min:0',
            'dataVenda'  => 'nullable|date'
        ]);

        Venda::create([
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'valorTotal' => $request->valorTotal,
            'dataVenda'  => $request->dataVenda ?? now()->toDateString(),
        ]);

        return redirect()->route('vendas.index')
            ->with('success', 'Venda registrada com sucesso!');
    }

    public function exportCsv()
    {
        $vendas = Venda::with('produto')->get();

        $csv  = "\xEF\xBB\xBF";
        $csv .= "ID;Produto;Quantidade;Total;Data\n";

        foreach ($vendas as $v) {

            $data = $v->dataVenda
                ? '="' . \Carbon\Carbon::parse($v->dataVenda)->format('d/m/Y') . '"'
                : '---';

            $csv .= implode(';', [
                $v->id,
                $v->produto->nome ?? 'Produto removido',
                $v->quantidade,
                number_format($v->valorTotal, 2, '.', ''),
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

        $pdf = Pdf::loadView('vendas.pdf', compact('vendas'))
                    ->setPaper('a4', 'portrait');

        return $pdf->download('relatorio_vendas.pdf');
    }
}
