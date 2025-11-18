<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アンケート詳細</title>
</head>
<body>
    <h1>アンケート詳細</h1>

    <p>ID: {{ $answer->id }}</p>
    <p>氏名: {{ $answer->name }}</p>
    <p>メール: {{ $answer->email }}</p>
    <p>性別: {{ $answer->gender }}</p>
    <p>年代: {{ $answer->age->age }}</p>
    <p>メール送信可否: {{ $answer->is_send ? '可' : '不可' }}</p>

    <p>ご意見:</p>
    <pre>{{ $answer->opinion }}</pre>

    <p>登録日: {{ $answer->created_at }}</p>

    <br>

    {{-- 一覧に戻る（元いたページに戻る） --}}
    <a href="{{ url()->previous() }}">一覧に戻る</a>

    <br><br>

    {{-- 削除ボタン（課題12用） --}}
    <form action="{{ route('admin.destroy', $answer->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
    @csrf
    @method('DELETE')
    <button type="submit">削除</button>
    </form>
</body>
</html>
