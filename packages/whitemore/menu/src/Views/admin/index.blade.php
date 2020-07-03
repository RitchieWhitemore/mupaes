<?php
/**
 * @var $menu \Whitemore\Models\Menu
 */
?>

@extends('adminlte::page')

@section('title', 'Меню')

@section('content_header')
    <h1>Меню</h1>
@stop

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <p><a href="{{ route('menu.create') }}" class="btn btn-success">Добавить элемент в меню</a></p>

    {!! $menuTreeHtml !!}

@stop


@section('css')
    <link rel="stylesheet" href="/vendor/menu/css/sortable.css">
@endsection

@section('js')
    <script src="/vendor/jquery-ui/js/jquery-ui.min.js"></script>
    <script src="/vendor/menu/js/main.js"></script>
@endsection
