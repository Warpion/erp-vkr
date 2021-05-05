<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/styles/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/styles/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/styles/media.css') }}">
    <title>ERP</title>
</head>
<body>
    <div class="container-fluid welcome-container">
        <div class="row g-0">
            <div class="col-12 welcome-block">
                <div class="logo-name">ERP</div>
                <p>by Sigeti Pavel</p>
                <div class="welcome-buttons">
                    <a href="{{ route('login') }}"><div class="button">Авторизация</div></a>
                    <a href="{{ route('register') }}"><div class="button">Регистрация</div></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
