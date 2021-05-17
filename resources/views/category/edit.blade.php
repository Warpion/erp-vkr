@extends('layouts.dashboard')

@section('title', "Редактировать группу " . $category->title )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Редактировать группу  {{$category->title}}</h1>
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
                        <form action="{{ route('categories.update', [$category]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="title">Название группы</label>
                            <input id="title" type="text" name="title" value="{{ $category->title }}" placeholder="Название группы">
                            <label for="skill">Навык</label>
                            <select name="skill_id" id="skill">
                                <option value="">Нет навыка</option>
                                @foreach($skills as $skill)
                                    <option value="{{$skill->id}}" @if($skill->id == $category->skill_id) selected @endif>{{$skill->skill}}</option>
                                @endforeach
                            </select>
                            <label for="price">Вознаграждение</label>
                            <input id="price" type="number" name="price" value="{{ $category->price }}" placeholder="Вознаграждение">
                            <label for="rating">Навык сотрудника</label>
                            <input id="rating" type="number" name="rating" value="{{ $category->rating }}" placeholder="Навык сотрудника">
                            <label for="max_rating">Максимальный навык</label>
                            <input id="max_rating" type="number" name="max_rating" value="{{ $category->max_rating }}" placeholder="Максимальный навык">
                            <label for="time">Время выполнения</label>
                            <input id="time" type="time" name="time" value="{{ $category->time }}">
                            <button type="submit" class="button">Изменить категорию</button>
                        </form>
                        <form action="{{ route('categories.destroy', [$category]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="button">Удалить категорию со всеми заданиями</button>
                        </form>
                    </div>
                    <div class="edit-form-right">
                        <span class="area-label">Всего выполненно</span>
                        <p class="task-text">{{$category->tasks_complete}}</p>
                        <span class="area-label">Среднее время</span>
                        <p class="task-text">{{gmdate("H:i", $category->time_avg)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

