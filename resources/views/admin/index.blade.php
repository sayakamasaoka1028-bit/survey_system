<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アンケート管理画面</title>
</head>
<body>
    <h1>アンケート一覧</h1>
<table border="1">
    <thead>
        <tr>
            <th>氏名</th>
            <th>登録日</th>
            <th>キーワード</th>
            <th>年代</th>
            <th>メール送信許可</th>
            <th>性別</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->name }}</td>
                <td>{{ $answer->created_at }}</td>
                <td>{{ $answer->keyword ?? '-' }}</td>
                <td>{{ $answer->age->name ?? '-' }}</td>
                <td>{{ $answer->can_send ? '可' : '不可' }}</td>
                <td>{{ $answer->gender ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
