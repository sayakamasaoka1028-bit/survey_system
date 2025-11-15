<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// フロント（ユーザー側）
Route::get('/', [FrontController::class, 'index'])->name('index');
Route::post('/confirm', [FrontController::class, 'confirm'])->name('confirm');
Route::post('/store', [FrontController::class, 'store'])->name('store');
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

// 管理者ページ
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// GET /confirm が来たらトップページへ
Route::get('/confirm', function () {
    return redirect()->route('index');
});
