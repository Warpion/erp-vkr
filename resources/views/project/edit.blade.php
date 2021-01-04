<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project</title>
</head>
<body>
    <h1>{{ $project->title }}</h1>
    <p>Общее время: {{ $time }}</p>
    <br>
    <form action="{{ route('projects.destroy', [$project]) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit">Удалить проект со всеми заданиями</button>
    </form>
    <br>
    <a href="{{ route('tasks.create', [$project->id]) }}">Добавить задание</a>
    <ul>
        @foreach($project->tasks as $task)
            <li>
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->description }}</p>
                <p>{{ $task->category->time }}</p>
                <a href="{{ route('tasks.edit', [$task->id]) }}">Редактировать</a>
            </li>
        @endforeach
    </ul>

</body>
</html>
