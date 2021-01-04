<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Найти задание</title>
</head>
<body>
<h1>Доступные задания</h1>
    <ul>
        @foreach($tasks as $task)
            <li>
                {{ $task->title }}
                <form action="{{ route('taskUser.orderTask', [$task->id]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Бронировать задание</button>
                </form>
            </li>
            <br>
        @endforeach
    </ul>


</body>
</html>
