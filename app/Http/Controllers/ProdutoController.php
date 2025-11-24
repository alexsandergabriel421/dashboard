<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        Produto::create([
            'nome'      => $request->nomeProduto,
            'preco'     => $request->precoProduto,
            'categoria' => $request->categoria,
            'descricao' => $request->descricao, // opcional
        ]);

        return redirect()->route('produtos.index');
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome'      => $request->nomeProduto,
            'preco'     => $request->precoProduto,
            'categoria' => $request->categoria,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('produtos.index');
    }

    public function delete($id)
    {
        Produto::findOrFail($id)->delete();
        return redirect()->route('produtos.index');
    }

    public function exportCsv()
    {
        $produtos = Produto::all();
        $csv = "ID;Nome;Preço;Categoria\n";

        foreach ($produtos as $p) {
            $csv .= implode(';', [
                $p->id,
                $p->nome,
                number_format($p->preco, 2, '.', ''),
                $p->categoria
            ]) . "\n";
        }

        return response("\xEF\xBB\xBF".$csv)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename=produtos.csv');
    }

    public function exportPdf()
    {
        $produtos = Produto::all();

        $pdf = Pdf::loadView('exports.produtos_pdf', compact('produtos'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('produtos.pdf');
    }
}
