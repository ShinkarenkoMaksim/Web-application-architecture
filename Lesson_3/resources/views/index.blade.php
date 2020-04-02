@extends('layouts.app')

@section('title', 'Главная')

@section('menu')
    @include('menu.main')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Рады Вас видеть на нашем лучшем сайте новостей!</h1>
            </div>
        </div>
    </div>

@endsection
