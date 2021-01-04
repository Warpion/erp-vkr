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

<h2>Редактирование задания проекта: {{ $task->title }} </h2>

<form role="form" action="{{ route('tasks.update', [$id]) }}" method="post">
    @csrf
    @method('PUT')
    <input type="text" name="title" placeholder="Название" value="{{ $task->title }}">
    <br><br>
    <input type="number" name="order" placeholder="Порядок выполнения" value="{{ $task->order }}">
    <br><br>
    <textarea name="description" cols="50" rows="8" placeholder="Описание">{{ $task->description }}</textarea>
    <br><br>
    <select name="category_id" placeholder="Номер категориинщ">
        <option value="null">Выберите категорию заданий</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @if( $task->category_id == $category->id ) selected @endif>
                {{$category->title }}
            </option>
        @endforeach
    </select>
    <br><br>
    <button type="submit">Изменить задание</button>
</form>
<br>
<form action="{{ route('tasks.destroy', [$id]) }}" method="post">
    @method('DELETE')
    @csrf
    <button type="submit">Удалить задание</button>
</form>
</body>
</html>
