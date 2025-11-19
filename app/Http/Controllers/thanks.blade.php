// FrontController.php

public function store(Request $request)
{
    $data = $request->all(); // フォームから送られてきた全データを取得して $data に入れる
 // デバッグ用ログ
    \Log::info('store メソッドが呼ばれました'); // この store メソッドが実行されたことをログに記録する（デバッグ用）
    \Log::info('リクエスト内容:', $request->all()); // フォームの送信内容をログに出力して確認する
   Answer::create($data); // 取得したデータをそのまま answers テーブルに新規登録する
    // 完了画面に遷移
    return view('thanks'); // 登録が終わったら thanks.blade.php（サンクスページ）を表示する
}
