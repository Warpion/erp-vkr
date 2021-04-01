@extends('layouts.dashboard')

@section('title', 'Админ панель')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Группы заданий</h1>
            </div>
            <div class="col-12">
                <a href="{{ route('categories.create') }}" class="button category-button">Создать группу</a>
                <ul class="category-list">
                    @foreach($categories as $category)
                        <li class="category-item">
                            <a href="{{ route('categories.edit', [$category->id]) }}">
                            <div class="category-item-content">
                                <p>{{ $category->title }}</p>
                                <p>{{ $category->time }}</p>
                                <span class="cat-edit">Редактировать</span>
                            </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

@endsection
