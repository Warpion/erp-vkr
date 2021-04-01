@extends('layouts.dashboard')

@section('title', 'Админ панель')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Админ панель</h1>
            </div>
            <div class="col-md-4">
                <a href="{{ route('projects.index') }}" class="admin-item-link">
                    <div class="admin-item">
                        <img src="{{ asset('public/img/admin/project.svg') }}" alt="Проект">
                        Проекты
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('categories.index') }}">
                    <div class="admin-item">
                        <img src="{{ asset('public/img/admin/categories.svg') }}" alt="Группа">
                        Группы заданий
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('task.check') }}">
                    <div class="admin-item">
                        <img src="{{ asset('public/img/admin/tasks.svg') }}" alt="Задания">
                        Выполненные задания
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
