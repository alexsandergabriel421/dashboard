<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/download-funcionarios', [ExportController::class, 'funcionarios'])->name('csv.funcionarios');
Route::get('/download-produtos', [ExportController::class, 'produtos'])->name('csv.produtos');
Route::get('/download-vendas', [ExportController::class, 'vendas'])->name('csv.vendas');
