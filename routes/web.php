<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;

// Dashboard
Route::get('/', function() {
    return view('dashboard');
})->name('dashboard');

// CSV
Route::prefix('export')->group(function () {
    Route::get('/funcionarios', [ExportController::class, 'funcionarios'])->name('csv.funcionarios');
    Route::get('/produtos', [ExportController::class, 'produtos'])->name('csv.produtos');
    Route::get('/vendas', [ExportController::class, 'vendas'])->name('csv.vendas');
});
