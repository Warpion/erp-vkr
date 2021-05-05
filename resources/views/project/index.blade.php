@extends('layouts.dashboard')

@section('title', 'Проекты')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">Проекты</h1>
            </div>
            <div class="col-12">
                <a href="{{ route('projects.create') }}" class="button category-button">Добавить Проект</a>
                <ul class="category-list">
                    @foreach($projects as $project)
                        <li class="category-item">
                            <a href="{{ route('projects.edit' , ['project' => $project->id]) }}">
                                <div class="category-item-content">
                                    <p>{{ $project->title }}</p>
                                    <p>@php echo gmdate('H:i', $project->getTimeSum()) @endphp</p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>


            </div>
            <div class="col-12">
                {{ $projects->links() }}
            </div>
        </div>
    </div>


@endsection
