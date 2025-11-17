<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>システムへのご意見をお聞かせください</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h1 class="text-center mb-4">システムへのご意見をお聞かせください</h1>

    {{-- メッセージ表示 --}}
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('confirm') }}" method="POST">
        @csrf

        {{-- 氏名 --}}
        <div class="mb-3">
            <label class="form-label">氏名 <span class="text-danger">※</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        {{-- 性別 --}}
        <div class="mb-3">
            <label class="form-label">性別 <span class="text-danger">※</span></label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="男性" {{ old('gender')=='男性' ? 'checked' : '' }}>
                <label class="form-check-label">男性</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="女性" {{ old('gender')=='女性' ? 'checked' : '' }}>
                <label class="form-check-label">女性</label>
            </div>
        </div>

        {{-- 年代 --}}
        <div class="mb-3">
            <label class="form-label">年代 <span class="text-danger">※</span></label>
            <select name="age_id" class="form-select">
                <option value="">選択してください</option>
                @foreach ($ages as $age)
                    <option value="{{ $age->id }}" {{ old('age_id')==$age->id ? 'selected' : '' }}>
                        {{ $age->age }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- メール --}}
        <div class="mb-3">
            <label class="form-label">メールアドレス <span class="text-danger">※</span></label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        {{-- メール送信可否 --}}
        <div class="mb-3">
            <label class="form-label">メール送信可否</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_send" value="1" {{ old('is_send') ? 'checked' : '' }}>
                <label class="form-check-label">送信を許可します</label>
            </div>
        </div>

        {{-- ご意見 --}}
        <div class="mb-4">
            <label class="form-label">ご意見</label>
            <textarea name="opinion" class="form-control" rows="4">{{ old('opinion') }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary px-5">確認</button>
        </div>

    </form>

</div>

</body>

</body>
</html>
