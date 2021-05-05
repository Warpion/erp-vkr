@extends('layouts.dashboard')

@section('title', 'Список сотрудников')

@section('content')
   <div class="container">
       <div class="row">
           <div class="col-12">
               <h1 class="title">Список сотрудников</h1>
           </div>
           @foreach($usersList as $userItem)
               <div class="col-md-6">
                   <a href="{{ route('user.admin.show', ['id' => $userItem->id]) }}" class="user-link">
                       <div class="item-block margin-bottom-30">
                           <p class="item-p">{{ $userItem->name }}</p>
                           <span class="area-label">Текущий рейтинг</span>
                           <p class="item-p">{{ $userItem->rating }}</p>
                           <span class="button margin-0">Подробнее</span>
                       </div>
                   </a>
               </div>
           @endforeach
            <div class="col-12">{{ $usersList->links() }}</div>
       </div>
   </div>


@endsection
