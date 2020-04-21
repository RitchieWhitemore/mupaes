@extends('adminlte::page')

@section('title', 'Добавить категорию')

@section('content_header')
    <h1>Добавить категорию</h1>
@stop

@section('content')
    {!! Form::open()->multipart()->url(route('admin.categories.store')) !!}
    @include('admin.category._form')
    {!!Form::submit("Сохранить")!!}
    {!! Form::close() !!}
@stop
