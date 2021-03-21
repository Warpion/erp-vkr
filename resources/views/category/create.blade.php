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
<form action="{{ route('categories.store') }}" method="post">
    @csrf
    <input type="text" name="title" placeholder="Название категории">
    <br><br>
    <input type="number" name="price" placeholder="Цена за выполнение">
    <br><br>
    <input type="number" name="rating" placeholder="Навык сотрудника">
    <br><br>
    <input type="number" name="max_rating" placeholder="Максимальный навык" value="0">
    <br><br>
    <input type="time" name="time">
    <br><br>
    <button type="submit">Создать категорию</button>
</form>
</body>
</html>
