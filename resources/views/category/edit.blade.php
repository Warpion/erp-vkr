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
<form action="{{ route('categories.update', [$category]) }}" method="post">
    @csrf
    @method('PUT')
    <h1>Редактировать категорию</h1>
    <input type="text" name="title" value="{{ $category->title }}" placeholder="Название категории">
    <br><br>
    <input type="number" name="price" value="{{ $category->price }}" placeholder="Цена за выполнение">
    <br><br>
    <input type="number" name="rating" value="{{ $category->rating }}" placeholder="Навык сотрудника">
    <br><br>
    <input type="number" name="max_rating" value="{{ $category->max_rating }}" placeholder="Максимальный навык">
    <br><br>
    <input type="time" name="time" value="{{ $category->time }}">
    <br><br>
    <button type="submit">Изменить категорию</button>
</form>
<br>
<form action="{{ route('categories.destroy', [$category]) }}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit">Удалить категорию со всеми заданиями</button>
</form>
</body>
</html>

