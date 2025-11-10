<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>送信完了</title>
</head>
<body>
    <h1>ご意見を頂きありがとうございます。</h1>
    @if(session('message'))
    <p>{{ session('message') }}</p>
    @endif

    <form action="{{ route('index') }}" method="GET">
        <button type="submit">トップページへ</button>
    </form>
</body>
</html>
