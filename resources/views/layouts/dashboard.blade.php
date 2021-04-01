<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/styles/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/styles/style.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo-small">ERP</div>
                </div>
                <div class="col-md-9">
                    <div class="navigation">
                        <nav>
                            <ul class="menu">
                                <li><a href="{{ route('dashboard') }}">Главная</a></li>
                                <li><a href="{{ route('dashboard.tasks') }}">Задания</a></li>
                                @if($role === true)
                                    <li><a href="{{ route('admin') }}">Админ панель</a></li>
                                @endif
                            </ul>
                        </nav>
                        <div class="user-rating">
                            <img src="{{ asset('public/img/user/user.png') }}" alt="user">
                            <span class="user-score">{{ $user->rating }}</span>
                        </div>
                        <a href="{{ route('logout') }}" class="button">Выйти</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>

    </footer>

    <script src="{{ asset('public/js/script.js') }}"></script>
</body>
</html>
