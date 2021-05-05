@extends('layouts.dashboard')

@section('title', $project->title )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">{{ $project->title }}</h1>
            </div>
            <div class="col-12">
                <p>Общее время: {{ $time }}</p>
            </div>
            <div class="col-12">
                <div class="project-buttons">
                    <a href="{{ route('tasks.create', [$project->id]) }}" class="button">Добавить задание</a>
                    <a href="{{ route('project.editProject', [$project->id]) }}" class="button">Редактировать проект</a>
                    <form action="{{ route('projects.destroy', [$project]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="button">Удалить проект со всеми заданиями</button>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <div class="chart-wrapper">
                    <ul class="chart-values">
                        @php
                            for($i = 0; $i <= $maxTime; $i++) {
                                if(strlen($i) === 1) {
                                    echo "<li>0".strval($i)."</li>";
                                }
                                else {
                                     echo "<li>".strval($i)."</li>";
                                }
                            }

                        @endphp
                    </ul>
                    <ul class="chart-bars">
{{--                        <li data-duration="00:30-05:10" data-color="#b03532">Task</li>--}}
                        @foreach($tasks as $task)
                            <li data-duration="{{$task['startTime']}}-{{$task['endTime']}}" data-color="#33a8a5">{{$task['title']}}</li>
                        @endforeach
{{--                        <li data-duration="wed-sat" data-color="#33a8a5">Task</li>--}}
{{--                        <li data-duration="sun-tue" data-color="#30997a">Task</li>--}}
{{--                        <li data-duration="tue½-thu" data-color="#6a478f">Task</li>--}}
{{--                        <li data-duration="mon-tue½" data-color="#da6f2b">Task</li>--}}
{{--                        <li data-duration="wed-wed" data-color="#3d8bb1">Task</li>--}}
{{--                        <li data-duration="thu-fri½" data-color="#e03f3f">Task</li>--}}
{{--                        <li data-duration="mon½-wed½" data-color="#59a627">Task</li>--}}
{{--                        <li data-duration="fri-sat" data-color="#4464a1">Task</li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-12">

                @foreach($tasks as $task)
                    <a href="{{ route('tasks.edit', [$task['id']]) }}">
                    <div class="single-project-task">
                        <h2 class="task-title">{{ $task['title'] }}</h2>
                        <span class="area-label">Описание</span>
                        <p class="task-text">{{ $task['description'] }}</p>
                        <span class="area-label">Время выполнения</span>
                        <p class="task-text">@php echo gmdate('H:i', $task['time']) @endphp</p>
                        <span class="more">Подробнее</span>
                    </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection


