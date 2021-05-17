@extends('layouts.dashboard')

@section('title', "Создание группы" )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Создание группы</h1>
            </div>
            <div class="col-12">
                @if($errors->any())
                    <ul class="error">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <label for="title">Название группы</label>
                            <input id="title" type="text" name="title" placeholder="Название категории" value="{{ old('title') }}">
                            <label for="skill">Навык</label>
                            <select name="skill" id="skill">
                                <option value="">Выберите навык</option>
                                @foreach($skills as $skill)
                                    <option value="{{$skill->id}}">{{$skill->skill}}</option>
                                @endforeach
                            </select>
                            <label for="price">Вознаграждение</label>
                            <input id="price" type="number" name="price" placeholder="Цена за выполнение" value="{{ old('price') }}">
                            <label for="rating">Навык сотрудника</label>
                            <input id="rating" type="number" name="rating" placeholder="Навык сотрудника" value="{{ old('rating') }}">
                            <label for="max_rating">Максимальный навык</label>
                            <input id="max_rating" type="number" name="max_rating" placeholder="Максимальный навык" value="0" {{ old('max_rating') }}>
                            <label for="time">Время выполнения</label>
                            <input id="time" type="time" name="time" value="{{ old('time') }}">
                            <button type="submit" class="button">Создать группу</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
