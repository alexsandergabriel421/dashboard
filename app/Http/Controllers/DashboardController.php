<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Produto;
use App\Models\Venda;

class DashboardController extends Controller
{
    public function index()
    {
        /* ============================
            CARDS
        ============================ */
        $totalFuncionarios  = Funcionario::count();
        $totalProdutos      = Produto::count();
        $totalVendas        = Venda::count();
        $mediaPrecoProdutos = Produto::avg('preco') ?? 0; // CORRIGIDO


        /* ===========================================
             GRÁFICO — VENDAS AGRUPADAS POR PRODUTO
        ============================================ */
        $vendas = Venda::with('produto')
            ->select('produto_id') // CORRIGIDO
            ->selectRaw('SUM(quantidade) as total')
            ->groupBy('produto_id')
            ->get();

        // Labels corretos (nome do produto)
        $labelsVendas = $vendas->map(function ($v) {
            return $v->produto->nome ?? 'Produto removido'; // CORRIGIDO
        })->values()->toArray();

        // Valores
        $valuesVendas = $vendas->pluck('total')
            ->map(fn($x) => (int) $x)
            ->values()
            ->toArray();


        /* ===========================================
             GRÁFICO — FUNCIONÁRIOS POR CARGO
        ============================================ */
        $cargoData = Funcionario::select('cargoFuncionario')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('cargoFuncionario')
            ->get();

        $labelsFuncionarios = $cargoData->pluck('cargoFuncionario')->values()->toArray();
        $valuesFuncionarios = $cargoData->pluck('total')->map(fn($x) => (int)$x)->values()->toArray();


        /* ===========================================
             RETORNO PARA A VIEW
        ============================================ */
        return view('dashboard', compact(
            'totalFuncionarios',
            'totalProdutos',
            'totalVendas',
            'mediaPrecoProdutos',
            'labelsVendas',
            'valuesVendas',
            'labelsFuncionarios',
            'valuesFuncionarios'
        ));
    }
}
