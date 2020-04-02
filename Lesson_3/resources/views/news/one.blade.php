@extends('layouts.app')

@section('title', 'Одна новость')

@section('menu')
    @include('menu.main')
@endsection

@section('content')
    @if(!$news->is_private || Auth::id())

        <div class="card mt-4 ml-auto mr-auto" style="width: 50rem;">
            <img src="{{ !strncasecmp($news->img, 'http', 4) ? $news->img : ($news->img ? asset('storage/' . $news->img) : asset('img/default.jpg')) }}" class="card-img-top w-25 ml-auto mr-auto mt-2" alt="{{ $news->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $news->title }}</h5>
                <p class="card-text">{!! $news->text !!}</p>
                <a href="{{ asset('/news/all') }}" class="btn btn-primary">Все новости</a>
            </div>
        </div>

    @else
        <br>Нет прав
    @endif
@endsection
