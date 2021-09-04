@extends('adminlte::page')

@section('title', 'マンデルブロ集合')

@section('content_header')
    <h1>ダッシュボード2</h1>
@stop

@section('content')
    <p>ここがコンテンツ部分です</p>
@stop

@section('css')
    {{-- ページごとCSSの指定
    <link rel="stylesheet" href="/css/admin_custom.css">
    --}}
@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop
