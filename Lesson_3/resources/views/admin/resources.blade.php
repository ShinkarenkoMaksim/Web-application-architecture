@extends('layouts.app')

@section('title', 'Админка')

@section('menu')
    @include('menu.admin')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Список ресурсов</h1>
                <a class="btn btn-success mb-3" href="{{ route('admin.resources.create') }}">Добавить ресурс</a>
            </div>
        </div>
    </div>

    <div class="list-group">
        @forelse($resources as $item)

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $item->url }}</h2>
                    <div class="d-flex">
                        <form action="{{ route('admin.resources.edit', $item) }}" method="GET" class="mr-1">
                            @csrf
                            <button class="btn btn-secondary" type="submit">Edit</button>
                        </form>
                        <form action="{{ route('admin.resources.destroy', $item) }}" method="POST" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <p>Нет ресурсов</p>

        @endforelse

    </div>
@endsection
