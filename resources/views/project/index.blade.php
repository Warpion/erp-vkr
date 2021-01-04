<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project List</title>
</head>
<body>
<a href="{{ route('logout') }}">Выйти</a>
<br><br>
<a href="{{ route('projects.create') }}">Добавить Проект</a>
    @foreach($projects as $project)
        <div class="item">
            <h3>{{ $project->title }}</h3>
            <p>{{ $project->getTimeSum() }}</p>
            <a href="{{ route('projects.edit' , ['project' => $project->id]) }}">Подробнее</a>
        </div>
        <br>
    @endforeach

    {{ $projects->links() }}

</body>
</html>
