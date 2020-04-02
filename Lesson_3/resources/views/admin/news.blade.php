@extends('layouts.app')

@section('title', 'Админка')

@section('menu')
    @include('menu.admin')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Список новостей</h1>
                <a class="btn btn-success mb-3" href="{{ route('admin.news.create') }}">Добавить новость</a>
            </div>
        </div>
    </div>

    <div class="row row-cols-3">
        @forelse($news as $item)

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h2 class="card-title">{{ $item->title }}</h2>
                    <div class="d-flex">
                        <a class="btn btn-primary mr-1" href="{{ route('admin.news.show', $item) }}">Подробнее...</a>
                        <form action="{{ route('admin.news.edit', $item) }}" method="GET" class="mr-1">
                            @csrf
                            <button class="btn btn-secondary" type="submit">Edit</button>
                        </form>
                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <p>Нет новостей</p>

        @endforelse

    </div>
    {{ $news->links() }}
@endsection
