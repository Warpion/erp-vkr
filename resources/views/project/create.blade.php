@extends('layouts.dashboard')

@section('title', "Создание проекта" )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Создать новый проект</h1>
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="{{ route('projects.store') }}" method="post">
                            @csrf
                            <label for="title">Название проекта</label>
                            <input id="title" type="text" name="title" placeholder="Название проекта" required>
                            <label for="urgency">Приоритет</label>
                            <select id="urgency" name="urgency" placeholder="Приоритет проекта">
                                <option value="1">Высокий</option>
                                <option value="2">Повышенный</option>
                                <option value="3" selected>Обычный</option>
                            </select>
                            <button type="submit" class="button">Создать новый проект</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
