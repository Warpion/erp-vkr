<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Контроль панель</title>
</head>
<body>
    <h1>Контрольная панель</h1>
    Вы вошли как: {{ $name }}
    <ul>
        @foreach($currentTasks as $task)
            <li>
                Задание: {{ $task->title }}
                <br>
                Тип задания: {{ $task->category->title }}
                <br>
                Время выполнения: {{ $task->category->time }}
                <br>
                <a href="{{ route('taskUser.show', [$task->id]) }}">Подробнее</a>
            </li>
            <br>
        @endforeach
    </ul>
</body>
</html>
