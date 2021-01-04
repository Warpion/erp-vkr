<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Задание: {{ $task->title }}</title>
</head>
<body>
    <h1>Задание: {{ $task->title }}</h1>

    <p>{{ $task->description }}</p>
    <p>Цена выполнения: {{ $task->category->price }}</p>
    <p>Начало выполнения: {{ $start }}</p>

    <form action="{{ $formAction }}" method="post">
        @csrf
        @method('PATCH')
        <button type="submit">{{ $buttonContent }}</button>
    </form>

</body>
</html>
