// FrontController.php

public function store(Request $request)
{
    $data = $request->all();
 // デバッグ用ログ
    \Log::info('store メソッドが呼ばれました');
    \Log::info('リクエスト内容:', $request->all());
   Answer::create($data);
    // 完了画面に遷移
    return view('thanks');
}
