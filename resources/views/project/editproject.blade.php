@extends('layouts.dashboard')

@section('title', "Редактировать проект " . $project->title )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Редактировать проект: {{$project->title}}</h1>
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form method="post" action="{{ route('project.editProjectStore', [$project->id]) }}">
                            @csrf
                            @method('PATCH')
                            <label for="title">Название проекта</label>
                            <input id="title" type="text" name="title" value="{{ $project->title }}" placeholder="Название проекта" required>
                            <label for="urgency">Приоритет</label>
                            <select id="urgency" name="urgency" placeholder="Приоритет проекта">
                                <option value="1" {{($project->urgency === 1) ? 'selected' : ''}}>Высокий</option>
                                <option value="2" {{($project->urgency === 2) ? 'selected' : ''}}>Повышенный</option>
                                <option value="3" {{($project->urgency === 3) ? 'selected' : ''}}>Обычный</option>
                            </select>
                            <button type="submit" class="button">Изменить проект</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
