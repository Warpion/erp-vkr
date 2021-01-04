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

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<h2>Добавление задания к проекту: {{ $task->title }}</h2>
<form action="{{ route('tasks.store', ['id' => $id]) }}" method="post">
    @csrf
    <input type="text" name="title" placeholder="Название">
    <input type="hidden" name="project_id" value="{{ $id }}">
    <br><br>
    <input type="number" name="order" placeholder="Порядок выполнения">
    <br><br>
    <textarea name="description" cols="50" rows="8" placeholder="Описание"></textarea>
    <br><br>
    <select name="category_id" placeholder="Номер категориинщ">
        <option value="null">Выберите категорию заданий</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->title }}
            </option>
        @endforeach
    </select>
    <br><br>
    <button type="submit">Добавить задание</button>
</form>
</body>
</html>
