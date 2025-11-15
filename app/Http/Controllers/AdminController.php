<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Answer::query();

        // 🔍 氏名 LIKE検索
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }

        // 🔍 メール LIKE検索
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }

        // 🔍 年代
        if ($request->filled('age_id')) {
            $query->where('age_id', $request->age_id);
        }

        // 🔍 性別
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // 🔍 メール送信可否 (0=不可, 1=可)
        if ($request->has('is_send_email') && $request->is_send_email !== '') {
            $query->where('is_send_email', $request->is_send_email);
        }

        // 🔍 キーワード（opinion と email）
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
            $q->where('opinion', 'like', "%{$request->keyword}%")
            ->orWhere('email', 'like', "%{$request->keyword}%");


            });
        }

        // 🔍 登録日（期間検索）
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // ⬇ 並び替え・ページネーション
        $answers = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.index', compact('answers'));
    }
public function show(Answer $answer)
{
    return view('admin.show', compact('answer'));
}
public function destroy(Answer $answer)
{
    $answer->delete();

    return redirect()->route('admin.index')->with('message', '削除しました');
}
public function massDestroy(Request $request)
{
    $ids = $request->ids;

    if (!$ids) {
        return redirect()->back()->with('message', '削除する項目を選択してください');
    }

    Answer::whereIn('id', $ids)->delete();

    return redirect()->route('admin.index')
        ->with('message', '選択したアンケートを削除しました');
}

}
