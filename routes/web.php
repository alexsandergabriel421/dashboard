<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\AuthController;



/*
|--------------------------------------------------------------------------
| ROTA INICIAL → LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});



/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

// Páginas (views)
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');

// Ações
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



/*
|--------------------------------------------------------------------------
| DASHBOARD (PROTEGIDO)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');



/*
|--------------------------------------------------------------------------
| FUNCIONÁRIOS
|--------------------------------------------------------------------------
*/
Route::prefix('funcionarios')->middleware('auth')->group(function () {
    Route::get('/', [FuncionarioController::class, 'index'])->name('funcionarios.index');
    Route::get('/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
    Route::post('/store', [FuncionarioController::class, 'store'])->name('funcionarios.store');
    Route::get('/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
    Route::post('/{id}/update', [FuncionarioController::class, 'update'])->name('funcionarios.update');
    Route::get('/{id}/delete', [FuncionarioController::class, 'destroy'])->name('funcionarios.delete');
});

// Exportações Funcionários
Route::middleware('auth')->group(function () {
    Route::get('/export/funcionarios/csv', [FuncionarioController::class, 'exportCsv'])
        ->name('export.funcionarios.csv');

    Route::get('/export/funcionarios/pdf', [FuncionarioController::class, 'exportPdf'])
        ->name('export.funcionarios.pdf');
});



/*
|--------------------------------------------------------------------------
| PRODUTOS
|--------------------------------------------------------------------------
*/
Route::prefix('produtos')->middleware('auth')->group(function () {
    Route::get('/', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/store', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/{id}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::post('/{id}/update', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::get('/{id}/delete', [ProdutoController::class, 'destroy'])->name('produtos.delete');
});

// Exportações Produtos
Route::middleware('auth')->group(function () {
    Route::get('/export/produtos/csv', [ProdutoController::class, 'exportCsv'])
        ->name('export.produtos.csv');

    Route::get('/export/produtos/pdf', [ProdutoController::class, 'exportPdf'])
        ->name('export.produtos.pdf');
});



/*
|--------------------------------------------------------------------------
| VENDAS
|--------------------------------------------------------------------------
*/
Route::prefix('vendas')->middleware('auth')->group(function () {
    Route::get('/', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::post('/store', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/{id}/edit', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::post('/{id}/update', [VendaController::class, 'update'])->name('vendas.update');
    Route::get('/{id}/delete', [VendaController::class, 'destroy'])->name('vendas.delete');
});

// Exportações Vendas
Route::middleware('auth')->group(function () {
    Route::get('/export/vendas/csv', [VendaController::class, 'exportCsv'])
        ->name('export.vendas.csv');

    Route::get('/export/vendas/pdf', [VendaController::class, 'exportPdf'])
        ->name('export.vendas.pdf');
});
