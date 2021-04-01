@extends('layouts.dashboard')

@section('title', 'Выполненные задания')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Выполненные задания</h1>
            </div>
            <div class="col-12">
                <ul>
                    @foreach($tasks as $task)
                        <li>
                            <div class="single-task-check">
                            <h2 class="task-title">{{ $task->title }}</h2>
                            <span class="area-label">Тип задания</span>
                            <p class="task-text">{{ $task->category->title}}</p>
                            <span class="area-label">Описание</span>
                            <p class="task-text">{{ $task->description}}</p>
                            <span class="area-label">Выполнил</span>
                            <p class="task-text">{{ $task->user->name }}</p>
                            <form action="{{ route('task.accept', [$task->id]) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="button margin-0 button-accept">Приянять выполнение задания</button>
                            </form>
                            <br>
                            <form action="{{ route('task.decline', [$task->id]) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="button margin-0">Отказ в выполнении задания</button>
                            </form>
                            <br>
                            <form action="{{ route('task.restart', [$task->id]) }}" method="post">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class="button margin-0 button-hard-decline">Отказать и запустить задание</button>
                            </form>
                            </div>
                        </li>

                        <br>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
