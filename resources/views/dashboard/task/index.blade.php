@extends('layouts.dashboard')

@section('title', 'Доступные задания')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Доступные задания</h1>
            </div>
            <div class="col-12">
                <ul class="get-task-list">
                    @foreach($tasks as $task)
                        <li>
                            <div class="current-task-item">
                            <p class="task-title">{{ $task->title }}</p>
                            <span class="area-label">Описание</span>
                            <p class="task-text">{{ $task->description }}</p>
                            <span class="area-label">Цена задания</span>
                            <p class="task-price single-task-price">{{ $task->setPrice }}</p>
                            <span class="area-label">Приоритет</span>
                            <div class="single-task-urgency"></div>
                            <p class="task-urgency">
                                @if($task->urgency === 3) Обычный
                                @elseif($task->urgency === 2) Повышенный
                                @else Высокий
                                @endif
                                <span class="urgency-ind urgency-ind-{{ $task->urgency }}"></span>
                            </p>
                            <form action="{{ route('taskUser.orderTask', [$task->id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="button margin-0">Бронировать задание</button>
                            </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection
