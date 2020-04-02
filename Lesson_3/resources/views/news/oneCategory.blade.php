@extends('layouts.app')

@section('title', 'Новости категории ' . $category)

@section('menu')
    @include('menu.main')
@endsection

@section('content')
    <h2 class="m-3 modal-header">Новости категории {{ $category }}</h2>
    <div class="row row-cols-3">
        @forelse($news as $item)

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h2 class="card-title">{{ $item->title }}</h2>
                    <div class="card-img mb-3"
                         style="background-image: url({{ !strncasecmp($item->img, 'http', 4) ? $item->img : ($item->img ? asset('storage/' . $item->img) : asset('img/default.jpg')) }})"></div>
                    @if(!$item->is_private)
                        <a class="btn btn-primary" href="{{ route('news.one', $item->id) }}">Подробнее...</a>
                    @endif
                </div>
            </div>

        @empty
            <p>Нет новостей</p>

        @endforelse
        {{ $news->links() }}
    </div>

@endsection
