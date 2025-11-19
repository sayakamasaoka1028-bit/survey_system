<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Age;
use App\Models\Answer;

class FrontController extends Controller
{
    // フォーム表示
    public function index()
    {
        $ages = Age::orderBy('sort')->get(); // 年代を並び順（sort）で取得
        return view('index', compact('ages')); // indexビューへ ages を渡す
    }

    // 確認画面
public function confirm(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|max:50', // 名前：必須・最大50文字
        'gender' => 'required',  // 性別：必須
        'email' => 'required|email', // メール：必須・メール形式
        'age_id' => 'required', // 年代：必須（プルダウン選択）
        'opinion' => 'required|max:10000', // ご意見：必須・最大10000文字
        'is_send' => 'nullable',  // メール送信可否：任意（null可）
    ]);

    // 入力内容
    $data = $validated; // バリデーション後のデータを $data に代入

    // 年代マスタから取得（★これが必要！）
    $age = Age::find($data['age_id']); // 年代IDから年代名（例：20代）を取得
    //select * from ages where id = 3 limit 1;
    return view('confirm', compact('data', 'age')); // confirmビューへ data と age を渡す
}

    // 保存処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50', // 名前は必須・最大50文字
            'gender' => 'required', // 性別は必須
            'email' => 'required|email', // メールは必須・正しい形式のみ
            'age_id' => 'required', // 年代（ID）は必須
            'opinion' => 'required|max:10000', // ご意見は必須・最大10000文字
        ]);

        $validated['is_send_email'] = $request->has('is_send_email') ? 1 : 0;
 // チェックボックス「メール送信可」→ チェックされていれば1、されていなければ0をセット
        //Answer::create($validated);
//insert into `answers`
//(`name`, `gender`, `email`, `age_id`, `opinion`, `is_send_email`, `updated_at`, `created_at`) 
//values
//('入力された名前', '入力された性別', 'メールアドレス', 3, 'ご意見の内容', 1, '2025-11-18 12:00:00', '2025-11-18 12:00:00');

// POST後はサンクスページへリダイレクト
    return redirect()->route('thanks')->with('message', 'アンケートを送信しました。');
    }
}
