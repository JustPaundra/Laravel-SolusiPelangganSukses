<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalisaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('analisa', AnalisaController::class);
Route::post('/analisa_kepuasan', [AnalisaController::class, 'store'])->name('analisa_kepuasan.store');
Route::get('/analisa_kepuasan', [AnalisaController::class, 'index'])->name('analisa_kepuasan.index');
Route::put('/analisa_kepuasan/{id}', [AnalisaController::class, 'update'])->name('analisa_kepuasan.update');
Route::get('/analisa_kepuasan/print', [AnalisaController::class, 'print'])->name('analisa.print');

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');