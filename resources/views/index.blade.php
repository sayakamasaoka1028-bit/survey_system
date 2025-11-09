<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>システムへのご意見をお聞かせください</title>
</head>
<body>
    <h1>システムへのご意見をお聞かせください</h1>
{{-- メッセージ表示 --}}
@if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
@endif


    <!-- バリデーションエラー表示 -->
    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="{{ route('confirm') }}" method="POST">
    @csrf
    <label>氏名：</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>

    <label>性別：</label><br>
    <input type="radio" name="gender" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }}> 男性
    <input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性<br><br>

    <label>年代：</label><br>
    <select name="age_id">
        @foreach ($ages as $age)
            <option value="{{ $age->id }}" {{ old('age_id') == $age->id ? 'selected' : '' }}>
                {{ $age->age }}
            </option>
        @endforeach
    </select><br><br>

    <label>メールアドレス：</label><br>
    <input type="email" name="email" value="{{ old('email') }}"><br><br>

    <label>メール送信可否：</label><br>
    <input type="checkbox" name="can_send_email" value="1" {{ old('can_send_email') ? 'checked' : '' }}> 送信可<br><br>

    <label>ご意見：</label><br>
    <textarea name="opinion">{{ old('opinion') }}</textarea><br><br>

    <button type="submit">確認</button>
　　　　</form>
　　　　</body>
　　　　</html>
