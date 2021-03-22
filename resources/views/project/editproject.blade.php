<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактировать проект {{ $project->title }}</title>
</head>
<body>
    <form method="post" action="{{ route('project.editProjectStore', [$project->id]) }}">
        @csrf
        @method('PATCH')
        <input type="text" name="title" value="{{ $project->title }}" placeholder="Название проекта">
        <br><br>
        <select name="urgency">
            <option value="1" {{($project->urgency === 1) ? 'selected' : ''}}>Высокий</option>
            <option value="2" {{($project->urgency === 2) ? 'selected' : ''}}>Повышенный</option>
            <option value="3" {{($project->urgency === 3) ? 'selected' : ''}}>Обычный</option>
        </select>
        <br><br>
        <button type="submit">Изменить</button>
    </form>
</body>
</html>
