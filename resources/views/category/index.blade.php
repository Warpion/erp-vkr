<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категории</title>
</head>
<body>
    <h2>Категории</h2>
    <a href="{{ route('categories.create') }}">Создать категорию</a>
    <ul>
    @foreach($categories as $category)
        <li>
            <p>{{ $category->title }}</p>
            <p>{{ $category->time }}</p>
            <a href="{{ route('categories.edit', [$category->id]) }}">Редактировать</a>
        </li>
    @endforeach
    </ul>

    {{ $categories->links() }}
</body>
</html>
