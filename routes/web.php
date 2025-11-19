<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// フロント（ユーザー側）
Route::get('/', [FrontController::class, 'index'])->name('index');
// トップページ表示（アンケート入力画面）
Route::post('/confirm', [FrontController::class, 'confirm'])->name('confirm');
// 入力内容の確認画面へ遷移（POSTで送る）
Route::post('/store', [FrontController::class, 'store'])->name('store');
// 入力内容をデータベースに保存する処理を実行
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');
// 完了ページ（thanks）を表示するだけのルート
// 管理者ページ
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
// GET /confirm が来たらトップページへ
Route::get('/confirm', function () {
    return redirect()->route('index');
});
// 詳細画面
Route::get('/system/answers/{answer}', [AdminController::class, 'show'])
    ->name('admin.detail');
// 特定IDのアンケート詳細を見るためのルート（例：/system/answers/5）
//  削除（単体削除)
Route::delete('/system/answers/{answer}', [AdminController::class, 'destroy'])
    ->name('admin.destroy');
// 1件のアンケートを削除するルート
//一括削除（チェックボックスで複数削除)
Route::delete('/system/answers', [AdminController::class, 'massDestroy'])
    ->name('admin.massDestroy');
// 複数件を一括削除するためのルート
