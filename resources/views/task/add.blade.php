@extends('layouts.dashboard')

@section('title', "Создание задания" )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Добавление задания к проекту: {{ $projectTitle }}</h1>
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
                        <form action="{{ route('tasks.store', ['id' => $id]) }}" method="post">
                            @csrf
                            <label for="title">Название</label>
                            <input id="title" type="text" name="title" placeholder="Название" value="{{ old('title') }}">
                            <input type="hidden" name="project_id" value="{{ $id }}">
                            <label for="order">Порядок выполнения</label>
                            <input id="order" type="number" name="order" placeholder="Порядок выполнения" value="0">
                            <label for="description">Описание</label>
                            <textarea id="description" name="description" cols="50" rows="8" placeholder="Описание">{{ old('description') }}</textarea>
                            <label for="user_id">Исполнитель</label>
                            <select id="user_id" name="user_id" placeholder="Номер категориинщ">
                                <option value="" selected>Выберите исполнителя</option>
                                @foreach($employeeList as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->name.' '.$employee->rating }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category_id">Тип задания</label>
                            <select id="category_id" name="category_id" placeholder="Номер категориинщ">
                                <option value="null" selected>Выберите группу заданий</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="button">Добавить задание</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
