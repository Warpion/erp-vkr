@extends('layouts.dashboard')

@section('title', "Создание задания" )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Редактирование задания проекта: {{ $task->title }} </h1>
            </div>
            <div class="col-12">
                @if($errors->any())
                    <ul class="error">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="{{ route('tasks.update', [$id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="title">Название</label>
                            <input type="text" name="title" placeholder="Название" value="{{ $task->title }}">
                            <label for="order">Порядок выполнения</label>
                            <input type="number" name="order" placeholder="Порядок выполнения" value="{{ $task->order }}">
                            <label for="description">Описание</label>
                            <textarea name="description" cols="50" rows="8" placeholder="Описание">{{ $task->description }}</textarea>
                            <label for="category_id">Приоритет</label>
                            <select name="category_id" placeholder="Номер категориинщ">
                                <option value="null">Выберите категорию заданий</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if( $task->category_id == $category->id ) selected @endif>
                                        {{$category->title }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="button">Редактировать задание</button>
                        </form>
                        <form action="{{ route('tasks.destroy', [$id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="button">Удалить задание</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
