<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート管理システム - 詳細</title>

    <!-- ▼ ここにスタイルを直接貼る（親レイアウトが無いのでこれが一番楽） -->
    <style>
        body {
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
            background: #f5f7fa;
            padding: 40px;
        }

        .detail-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px 50px;
            border-radius: 8px;
        }

        .detail-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .detail-row {
            display: flex;
            padding: 14px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .detail-label {
            width: 180px;
            font-weight: bold;
            color: #333;
        }

        .detail-value {
            flex: 1;
            color: #555;
            line-height: 1.8;
        }

        .detail-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-back {
            background-color: #3cb371;
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn-delete {
            background-color: #d9534f;
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-back:hover { background-color: #2e8b57; }
        .btn-delete:hover { background-color: #c9302c; }

    </style>
</head>

<body>

<div class="detail-container">

    <div class="detail-title">アンケート管理システム</div>

    <div class="detail-table">

        <div class="detail-row">
            <div class="detail-label">ID</div>
            <div class="detail-value">{{ $answer->id }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">氏名</div>
            <div class="detail-value">{{ $answer->name }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">性別</div>
            <div class="detail-value">{{ $answer->gender }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">年代</div>
            <div class="detail-value">{{ $answer->age->name }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">メールアドレス</div>
            <div class="detail-value">{{ $answer->email }}</div>
        </div>

        <div class="detail-row">
            <div class="detail-label">メール送信可否</div>
            <div class="detail-value">
                {{ $answer->is_send_mail ? '送信許可' : '不可' }}
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-label">ご意見</div>
            <div class="detail-value">
                {{ $answer->opinion }}
            </div>
        </div>

        <div class="detail-row">
            <div class="detail-label">登録日時</div>
            <div class="detail-value">
                {{ $answer->created_at }}
            </div>
        </div>

    </div>

    <div class="detail-buttons">
        <a href="{{ route('admin.index') }}" class="btn-back">一覧に戻る</a>

        <form action="{{ route('admin.destroy', $answer->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">削除</button>
        </form>
    </div>

</div>

</body>
</html>
