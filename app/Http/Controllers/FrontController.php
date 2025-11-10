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
        $ages = Age::orderBy('sort')->get();
        return view('index', compact('ages'));
    }

    // 確認画面
    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'gender' => 'required',
            'email' => 'required|email',
            'age_id' => 'required',
            'opinion' => 'required|max:10000',
        ]);

        $data = $validated;
        $age = Age::find($data['age_id'])->age;

        return view('confirm', compact('data', 'age'));
    }

    // 保存処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'gender' => 'required',
            'email' => 'required|email',
            'age_id' => 'required',
            'opinion' => 'required|max:10000',
        ]);

        $validated['is_send_email'] = $request->has('is_send_email') ? 1 : 0;

        Answer::create($validated);

        return view('thanks');
    }
}
