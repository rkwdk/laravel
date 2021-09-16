@extends('adminlte::page')

@section('title', 'マンデルブロ集合')

@section('content')
    <div id="app">
        <body-component></body-component>
    </div>
@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/admin_custom.css">
    --}}
@stop

@section('js')
    <script src="{{ mix('/js/app.js') }}"></script>
@stop
