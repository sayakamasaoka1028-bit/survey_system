<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>アンケート管理システム</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f7f7f7;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form, table {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        a {
            color: #3490dc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        button {
            padding: 6px 12px;
            background-color: #e3342f;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #cc1f1a;
        }
        input[type="text"], select {
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
    </style>
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
<form action="{{ route('admin.massDestroy') }}" method="POST" id="mass-delete-form">
    @csrf
    @method('DELETE')
    <table border="1">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th>ID</th>
                <th>氏名</th>
                <th>性別</th>
                <th>年代</th>
                <th>メール送信可否</th>
                <th>登録日</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($answers as $answer)
            <tr>
                <td><input type="checkbox" name="ids[]" value="{{ $answer->id }}"></td>
                <td>{{ $answer->id }}</td>
                <td>{{ $answer->name }}</td>
                <td>{{ $answer->gender ?? '-' }}</td>
                <td>{{ $answer->age->age ?? '-' }}</td>
                <td>{{ $answer->is_send_email == 1 ? '可' : '不可' }}</td>
                <td>{{ $answer->created_at }}</td>
                <td><a href="{{ route('admin.detail', $answer->id) }}">詳細</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" onclick="return confirm('選択したアンケートを削除してもよろしいですか？')">
        選択削除
    </button>
</form>

<!-- ページネーション -->
{{ $answers->links('vendor.pagination.custom') }}

<!-- 🔹 全選択用JS -->
<script>
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('input[name="ids[]"]');

    selectAllCheckbox.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
