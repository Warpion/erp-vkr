<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/styles/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/styles/style.css') }}">
    <title>Авторизация</title>
</head>
<body>
<div class="container-fluid welcome-container">
    <div class="row g-0">
        <a href="{{ url()->previous() }}" class="back-url">&#60; Назад</a>
        <div class="col-12 welcome-block">
            @if($errors->any())
                <ul class="error">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf
                <h1>Авторизация</h1>
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" placeholder="E-mail">
                <label for="password">Пароль</label>
                <input id="password" type="password" name="password" placeholder="Пароль">
                <button type="submit" class="button">Войти</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
