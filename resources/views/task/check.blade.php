<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul>
        @foreach($tasks as $task)
            <li>
                {{ $task->id }}. {{ $task->title }} <br>
                Выполнил: {{ $task->user->name }}
                <br><br>
                <form action="{{ route('task.accept', [$task->id]) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <button type="submit">Приянять выполнение задания</button>
                </form>
                <br>
                <form action="{{ route('task.decline', [$task->id]) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <button type="submit">Отказ в выполнении задания</button>
                </form>
                <br>
                <form action="{{ route('task.restart', [$task->id]) }}" method="post">
                    @method('PATCH')
                    @csrf
                    <button type="submit">Отказать и запустить задание</button>
                </form>
            </li>
            <br>
        @endforeach
    </ul>
</body>
</html>

