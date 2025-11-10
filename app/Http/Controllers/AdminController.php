<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer; // モデルを読み込む

class AdminController extends Controller
{
    public function index()
    {
        // アンケートデータを全件取得
        $answers = Answer::with('age')->get();

        // admin/index.blade.php に渡す
        return view('admin.index', compact('answers'));
    }

}
