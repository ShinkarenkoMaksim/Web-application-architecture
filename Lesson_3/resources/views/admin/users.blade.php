@extends('layouts.app')

@section('title', 'Админка')

@section('menu')
    @include('menu.admin')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 card mt-3">
                <h2>Список пользователей</h2>
                @foreach($users as $item)

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h2 class="card-title">{{ $item->name }}</h2>
                            <div class="card-body">
                                <p>{{ $item->email }}</p>
                                <p>Администратор: {{ $item->is_admin ? 'да' : 'нет' }}</p>
                            </div>

                            <div class="d-flex">
                                <form action="{{ route('admin.users.edit', $item) }}" method="GET" class="mr-1">
                                    @csrf
                                    <button class="btn btn-secondary" type="submit">Edit</button>
                                </form>
                                {{--<button class="btn btn-secondary testApi" data-id="{{ $item->id }}">Test</button>--}}
                                @if(Auth::user() != $item)
                                    <form action="{{ route('admin.users.destroy', $item) }}" method="POST" class="mr-1">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

{{--    <script !src="">
        let buttons = document.querySelectorAll('.testApi');
        buttons.forEach((elem) => {
            elem.addEventListener('click', () => {
                console.log('sending...');
                let id = elem.getAttribute('data-id');
                (async () => {
                    const response = await fetch('/api/apiTest/?id=' + id);
                    const answer = await response.json();
                    console.log(answer);
                })();
            })
        })
    </script>--}}
@endsection
