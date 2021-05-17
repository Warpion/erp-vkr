@extends('layouts.dashboard')

@section('title', 'Админ панель')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Навыки</h1>
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="{{route('skills.store')}}" method="post">
                            @csrf
                            <label for="skill"></label>
                            <input id="skill" type="text" name="skill" placeholder="Название навыка">
                            <button class="button">Создать навык</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <ul class="category-list">
                    @foreach($skills as $skill)
                        <li class="category-item">
                            <div class="category-item-content">
                                <p>{{ $skill->skill }}</p>
                                <form action="{{route('skills.destroy', [$skill->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="skill-delete">Удалить</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                {{ $skills->links() }}
            </div>
        </div>
    </div>

@endsection
