@extends('layouts.dashboard')

@section('title', 'Задание '.$task->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Задание: {{ $task->title }}</h1>
            </div>
            <div class="col-12">
                <div class="current-task-item">
                    <span class="area-label">Описание</span>
                    <p class="task-text">{{ $task->description }}</p>
                    <span class="area-label">Начало выполнения</span>
                    <p class="task-text">@if(strlen($start) > 1){{ $start }} @else — — — @endif</p>
                    <span class="area-label">Вознаграждение</span>
                    <div class="task-price single-task-price">
                        {{ $task->setPrice }}
                    </div>
                    <form action="{{ $formAction }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="button margin-0">{{ $buttonContent }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
