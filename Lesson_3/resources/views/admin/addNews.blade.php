@extends('layouts.app')

@section('title')
    @parent Добавление новости
@endsection

@section('menu')
    @include('menu.admin')
@endsection

@section('content')
    <form class="mt-4" id="form"
          action="@if(!$news->id){{ route('admin.news.store') }} @else {{ route('admin.news.update', $news) }} @endif"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(request()->routeIs('admin.news.edit'))
            @method('PUT')
            <input type="hidden" name="id" value="{{ $news->id }}">
        @endif
        <div class="form-group">
            <label for="newsTitle">Название новости</label>
            @if($errors->has('title'))
                <div class="alert alert-danger" role="danger">
                    @foreach($errors->get('title') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input name="title" type="text" class="form-control" id="newsTitle" placeholder="Название новости"
                   value="{{ old('title') ?? $news->title ?? '' }}">
        </div>
        <div class="form-group">
            <label for="newsCategory">Категория новости</label>
            @if($errors->has('category_id'))
                <div class="alert alert-danger" role="danger">
                    @foreach($errors->get('category_id') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <select name="category_id" class="form-control" id="newsCategory">
                @forelse($categories as $item)
                    <option @if ($item->id) selected
                            @endif value="{{ $item->id }}">{{ $item->title }}</option>
                @empty
                @endforelse
                <option value="new_cat">Добавить категорию</option>

            </select>

            <input name="category" @if($categories->isEmpty()) style="display: block" @endif class="form-control"
                   type="text" id="category" placeholder="Имя категории"
                   value="{{ old('category') ? old('category') : '' }}"/>
        </div>
        <div class="form-group">
            <label for="textEdit">Текст новости</label>
            @if($errors->has('text'))
                <div class="alert alert-danger" role="danger">
                    @foreach($errors->get('text') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <textarea name="text" class="form-control" id="newsText"
                      rows="15">{!! old('text') ?? $news->text ?? '' !!}</textarea>
        </div>
        <div class="form-check">
            <input @if (old('is_private')) checked @endif name="is_private" class="form-check-input" type="checkbox"
                   value="1" id="privateNews">
            <label class="form-check-label" for="privateNews">
                Приватная новость
            </label>
        </div>
        <div class="form-group mt-2">
            <label for="img">Загрузите изображение</label>
            @if($errors->has('img'))
                <div class="alert alert-danger" role="danger">
                    @foreach($errors->get('img') as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <input name="img" type="file" class="form-control-file" id="img" accept="image/jpeg">
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            @if($news->id) Изменить @else Добавить @endif
        </button>
    </form>
    <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
    </script>
    <script>
        CKEDITOR.replace('newsText', options);
    </script>
@endsection
