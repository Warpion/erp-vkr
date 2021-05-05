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
    <link rel="stylesheet" href="{{ asset('public/styles/media.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    <div class="dark-back"></div>
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo-small">ERP</div>
                    <div class="bars"></div>
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
                                <li class="mobi-menu-item"><a href="{{ route('user') }}">Личный кабинет</a></li>
                                <li class="mobi-menu-item"><a href="{{ route('logout') }}">Выйти</a></li>
                            </ul>
                        </nav>
                        <a href="{{ route('user') }}" class="hide-768">
                            <div class="user-rating">
                                <img src="{{ asset('public/img/user/user.png') }}" alt="user">
                                <span class="user-score">{{ $user->rating }}</span>
                            </div>
                        </a>
                        <span class="exit mobi-menu-item"></span>
                        <a href="{{ route('logout') }}" class="button hide-768">Выйти</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <a href="{{ url()->previous() }}" class="dashboard-back-url">&#60; Назад</a>
        @yield('content')
    </main>
    <footer>

    </footer>

    <script src="{{ asset('public/js/script.js') }}"></script>
</body>
</html>
