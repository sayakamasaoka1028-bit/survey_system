<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h1 class="text-center mb-4">入力内容の確認</h1>

    <div class="card shadow-sm p-4">

        <div class="mb-3">
            <label class="form-label fw-bold">氏名</label>
            <p class="form-control">{{ $data['name'] }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">性別</label>
            <p class="form-control">{{ $data['gender'] }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">年代</label>
            <p class="form-control">{{ $age->age }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">メールアドレス</label>
            <p class="form-control">{{ $data['email'] }}</p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">メール送信可否</label>
            <p class="form-control">
                {{ ($data['is_send'] ?? false) ? '可' : '不可' }}
            </p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">ご意見</label>
            <p class="form-control" style="white-space: pre-wrap;">
                {{ $data['opinion'] }}
            </p>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-secondary px-4" onclick="history.back()">戻る</button>

            <form action="{{ route('store') }}" method="POST">
                @csrf
                @foreach ($data as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <input type="hidden" name="age" value="{{ $age->age }}">

                <button type="submit" class="btn btn-primary px-4">送信</button>
            </form>
        </div>

    </div>

</div>

</body>
</html>
