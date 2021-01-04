<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <br>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail">
        <br><br>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Имя">
        <br><br>
        <input type="password" name="password">
        <br><br>
        <input type="password" name="password_confirmation">
        <br><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>
