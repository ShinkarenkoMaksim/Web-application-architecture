@extends('layouts.app')

@section('title')
    @parent Добавление ресурса
@endsection

@section('menu')
    @include('menu.admin')
@endsection

@section('content')
    <form class="mt-4" id="form"
          action="@if(!$resource->id){{ route('admin.resources.store') }} @else {{ route('admin.resources.update', $resource) }} @endif"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(request()->routeIs('admin.resources.edit'))
            @method('PUT')
            <input type="hidden" name="id" value="{{ $resource->id }}">
        @endif
        <div class="form-group">
            <label for="url">Ссылка на ресурс</label>
            @if($errors->has('url'))
                <div class="alert alert-danger" role="danger">
                    @foreach($errors->get('url') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input name="url" type="url" class="form-control" id="url" placeholder="Ссылка на ресурс"
                   value="{{ old('url') ?? $resource->url ?? '' }}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            @if($resource->id) Изменить @else Добавить @endif
        </button>
    </form>
@endsection
