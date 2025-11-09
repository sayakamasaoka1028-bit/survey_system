<?php
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::post('/confirm', [FrontController::class, 'confirm'])->name('confirm');
Route::post('/store', [FrontController::class, 'store'])->name('store');
