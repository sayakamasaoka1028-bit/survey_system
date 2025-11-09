<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Age;   // 年代用モデル
use App\Models\Answer; // 回答用モデル

class FrontController extends Controller
{
    // フォーム表示
    public function index()
    {
        $ages = Age::orderBy('sort')->get();
        return view('index', compact('ages'));
    }

    // 確認画面
    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'age_id' => 'required',
            'opinion' => 'required|max:10000',
        ]);

        $data = $validated;
        $age = Age::find($data['age_id'])->age;

        return view('confirm', compact('data', 'age'));
    }

    // 保存
    public function store(Request $request)
    {
        $data = $request->all();
        Answer::create($data);

        return redirect()->route('index')->with('message', 'アンケートを送信しました');
    }
}
