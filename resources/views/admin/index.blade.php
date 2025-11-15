<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アンケート管理システム</title>
</head>
<body>
    <h1>アンケート管理システム</h1>

    <!-- 🔍 検索フォーム -->
    <form action="{{ route('admin.index') }}" method="GET">
        <label>キーワード：</label>
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="氏名やメールを入力">

        <label>年代：</label>
        <select name="age_id">
            <option value="">すべて</option>
            @foreach (\App\Models\Age::all() as $age)
                <option value="{{ $age->id }}" {{ request('age_id') == $age->id ? 'selected' : '' }}>
                    {{ $age->age }}
                </option>
            @endforeach
        </select>

        <label>性別：</label>
        <select name="gender">
            <option value="">すべて</option>
            <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
            <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
        </select>

        <button type="submit">検索</button>
        <a href="{{ route('admin.index') }}">リセット</a>
    </form>

    <!-- 🔹 アンケート一覧 -->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>氏名</th>
                <th>性別</th>
                <th>年代</th>
                <th>メール送信可否</th>
                <th>登録日</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($answers as $answer)
                <tr>
                    <td>{{ $answer->id }}</td>
                    <td>{{ $answer->name }}</td>
                    <td>{{ $answer->gender ?? '-' }}</td>
                    <td>{{ $answer->age->age ?? '-' }}</td>
<td>{{ $answer->is_send_email == 1 ? '可' : '不可' }}</td>
                    <td>{{ $answer->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $answers->links() }}
</body>
</html>
