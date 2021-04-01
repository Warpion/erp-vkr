@extends('layouts.dashboard')

@section('title', 'Контроль панель')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="title">Задания</h1>
        </div>
        <div class="col-12">
            <ul class="current-tasks">

                @foreach($currentTasks as $task)
                    <li >
                        <a href="{{ route('taskUser.show', ['id' => $task->taskId]) }}" class="current-task-link">
                            <div class="current-task-item">
                                @if($task->started_at !== null)
                                    <div class="task-in-work">
                                        <img src="{{ asset('public/img/user/hammers.svg') }}" alt="В работе">
                                    </div>
                                @endif
                                <div class="task-item-content">
                                    <div class="task-item-left">
                                        <span class="task-info task-info-title">{{ $task->title }}</span>
                                        <span class="task-info">Тип задания: {{ $task->ctitle }}</span>
                                        <span class="task-info">Время выполнения: {{ $task->approxTime }}</span>
                                    </div>
                                    <div class="task-item-right">
                                        <span class="task-price task-price-{{ $task->urgency }}">{{ $task->setPrice }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
