@extends('layouts.dashboard')

@section('title', 'Личный кабинет')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Личный кабинет</h1>
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="{{ route('user.update') }}" method="post">
                            @csrf
                            @method('PATCH')
                            <span class="area-label">Имя</span>
                            <input type="text" name="name" value="{{$user->name}}" placeholder="Ваше имя">
                            <span class="area-label">Текущий рейтинг</span>
                            <p class="item-p">{{ $user->rating }}</p>
                            <button class="button margin-0">Изменить данные</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h2 class="title margin-top-30">История заданий</h2>
            </div>
            @foreach($tasksDone as $task)
                <div class="col-md-6">
                    <div class="item-block margin-bottom-30">
                        <span class="area-label">Название</span>
                        <p class="item-p">{{ $task->title }}</p>
                        <span class="area-label">Выполнено в</span>
                        <p class="item-p">{{ $task->done_at }}</p>
                        <span class="area-label">Результат</span>
                        <p class="task-price single-task-price">{{ $task->profit }}</p>
                    </div>
                </div>
            @endforeach
            <div class="col-12">{{ $tasksDone->links() }}</div>
        </div>
    </div>

@endsection
