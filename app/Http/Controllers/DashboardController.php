<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔹 Consultas de agregação
        $totalFuncionarios = DB::table('tbFuncionario')->count();
        $totalProdutos = DB::table('tbProduto')->count();
        $totalVendas = DB::table('tbVendas')->count();
        $mediaPrecoProdutos = DB::table('tbProduto')->avg('precoProduto');

        return view('dashboard', compact(
            'totalFuncionarios',
            'totalProdutos',
            'totalVendas',
            'mediaPrecoProdutos'
        ));
    }
}
