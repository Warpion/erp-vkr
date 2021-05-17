@extends('layouts.dashboard')

@section('title', 'История заданий')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Данные: {{ $employee->name }}</h1>
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="" method="post">
                            @csrf
                            <label for="skill">Навык</label>
                            <select name="skill_id" id="skill">
                                @foreach($optionSkills as $item)
                                    <option value="{{$item->id}}">{{$item->skill}}</option>
                                @endforeach
                            </select>
                            <label for="rating">Рейтинг навыка</label>
                            <input type="text" name="rating">
                            <button class="button">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h2 class="title">Навыки</h2>
            </div>
            <div class="col-12">
                <ul class="category-list">
                    @foreach($userSkills as $skill)
                        <li class="category-item">
                            <a href="{{ route('usersskill.edit', [$employee->id,$skill->id]) }}">
                                <div class="category-item-content">
                                    <p>{{ $skill->skill->skill }}</p>
                                    <p>Квалификация: {{ $skill->rating }}</p>
                                    <span class="cat-edit">Редактировать</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                <h2 class="title">История заданий</h2>
            </div>
            @foreach($employeeTasks as $task)
                <div class="col-md-6">
                    <div class="item-block margin-bottom-30">
                        <span class="area-label">Название</span>
                        <p class="item-p">{{ $task->title }}</p>
                        <span class="area-label">Результат</span>
                        <p class="item-p">{{ $task->profit }}</p>
                        <form action="{{ route('task.deleteResult', [$task->id]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button class="button margin-0">Удалить результат</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                {{ $employeeTasks->links() }}
            </div>
        </div>
    </div>


@endsection
