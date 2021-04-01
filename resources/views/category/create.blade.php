@extends('layouts.dashboard')

@section('title', "Создание группы" )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Создание группы</h1>
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <label for="title">Название группы</label>
                            <input id="title" type="text" name="title" placeholder="Название категории">
                            <label for="price">Вознаграждение</label>
                            <input id="price" type="number" name="price" placeholder="Цена за выполнение">
                            <label for="rating">Навык сотрудника</label>
                            <input id="rating" type="number" name="rating" placeholder="Навык сотрудника">
                            <label for="max_rating">Максимальный навык</label>
                            <input id="max_rating" type="number" name="max_rating" placeholder="Максимальный навык" value="0">
                            <label for="time">Время выполнения</label>
                            <input id="time" type="time" name="time">
                            <button type="submit" class="button">Создать категорию</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
