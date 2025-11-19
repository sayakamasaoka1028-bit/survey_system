<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AdminController extends Controller
{
    // 一覧ページ
    public function index(Request $request)
    {
        $query = Answer::query();

        // 氏名検索（name の入力がある場合に部分一致で検索）
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%"); // %で前後部分一致
        }

        // メール検索（email の入力がある場合に部分一致で検索）
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // 年代検索（age_id がフォームで選択されている場合）
        if ($request->filled('age_id')) {
            $query->where('age_id', $request->age_id); // 完全一致
        }

        // 性別検索（gender が選択されている場合）
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender); // 男・女などの完全一致
        }

        // メール送信可否
        // フォームで「is_send_email」が送信されているか確認
        // かつ、値が空文字ではない場合のみ処理を実行
        if ($request->has('is_send_email') && $request->is_send_email !== '') {
        // クエリに「is_send_email」の条件を追加
        // 0（不可）または 1（可）に応じて絞り込み

        $query->where('is_send_email', $request->is_send_email);
        }

        // キーワード検索
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('opinion', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        $answers = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.index', compact('answers'));
    }

    // 詳細ページ
    public function show($id)
    {
        $answer = Answer::findOrFail($id); // IDで取得
        return view('admin.detail', compact('answer'));
    }

    // 単体削除
    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return redirect()->route('admin.index')->with('message', '回答を削除しました');
    }

    // 選択削除（複数削除）
    public function massDestroy(Request $request)
    {
        $ids = $request->input('ids'); // フォームから配列で送られてくる想定
        if (!empty($ids)) {
            Answer::whereIn('id', $ids)->delete();
        }

        return redirect()->route('admin.index')->with('message', '選択した回答を削除しました');
    }
}
