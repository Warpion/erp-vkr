@extends('layouts.dashboard')

@section('title', 'История заданий')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">История заданий: {{ $user->name }}</h1>
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
