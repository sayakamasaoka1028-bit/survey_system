<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
</head>
<body>
    <h1>内容確認</h1>
    <p>氏名：{{ $data['name'] }}</p>
    <p>性別：{{ $data['gender'] }}</p>
    <p>年代：{{ $age }}</p>
    <p>メールアドレス：{{ $data['email'] }}</p>
    <p>メール送信可否:
    @if(!empty($data['can_send_email']))
        送信可
    @else
        送信不可
    @endif


    </p>
    <p>ご意見：{!! nl2br(e($data['opinion'])) !!}</p>
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <input type="hidden" name="name" value="{{ $data['name'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="age_id" value="{{ $data['age_id'] }}">
        <input type="hidden" name="opinion" value="{{ $data['opinion'] }}">
        <button type="submit">送信</button>
    </form>

    <form action="{{ route('index') }}" method="GET">
        <button type="submit">再入力</button>
    </form>
</body>
</html>
