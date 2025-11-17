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
        $mediaPrecoProdutos = Produto::avg('precoProduto');


        /* ===========================================
             GRÁFICO — VENDAS AGRUPADAS POR PRODUTO
        ============================================ */
        $vendas = Venda::with('produto')
            ->selectRaw('idProduto, SUM(quantidade) as total')
            ->groupBy('idProduto')
            ->get();

        // DEBUG — PARA VER O QUE ESTÁ VINDO
        // dd($vendas);

        $labelsVendas = $vendas->map(function ($v) {
            return $v->produto->nomeProduto ?? 'Produto removido';
        });

        $valuesVendas = $vendas->pluck('total');


        /* ===========================================
             GRÁFICO — FUNCIONÁRIOS POR CARGO
        ============================================ */
        $cargoData = Funcionario::select('cargoFuncionario')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('cargoFuncionario')
            ->get();

        $labelsFuncionarios = $cargoData->pluck('cargoFuncionario');
        $valuesFuncionarios = $cargoData->pluck('total');


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
