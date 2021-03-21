<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Создать новый проект</h1>
    <form action="{{ route('projects.store') }}" method="post">
        @csrf
        <input type="text" name="title" placeholder="Название проекта" required>
        <br><br>
        <select name="urgency" placeholder="Приоритет проекта">
            <option value="1">Высокий</option>
            <option value="2">Повышенный</option>
            <option value="3" selected>Обычный</option>
        </select>
        <br><br>
        <button type="submit">Создать новый проект</button>
    </form>
</body>
</html>
