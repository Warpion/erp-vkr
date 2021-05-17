@extends('layouts.dashboard')

@section('title', 'История заданий')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="title">{{$userSkill->skill->skill}}: {{ $employee->name }}</h1>
            </div>
            <div class="col-12">
                <div class="edit-form">
                    <div class="edit-form-left">
                        <form action="{{route('usersskill.update', [$userSkill->id])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <label for="skill">Навык</label>
                            <p>{{$userSkill->skill->skill}}</p>
                            <br>
                            <label for="rating">Рейтинг навыка</label>
                            <input type="text" name="rating" value="{{$userSkill->rating}}">
                            <button class="button">Редактировать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
