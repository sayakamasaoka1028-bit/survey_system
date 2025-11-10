<?php
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::post('/confirm', [FrontController::class, 'confirm'])->name('confirm');
Route::post('/store', [FrontController::class, 'store'])->name('store');
Route::get('/thanks', function() {
    return view('thanks');
})->name('thanks');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/confirm', function() {
    return redirect()->route('thanks'); //
});
