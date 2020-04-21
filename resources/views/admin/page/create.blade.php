@extends('adminlte::page')

@section('title', 'Добавить страницу')

@section('content_header')
    <h1>Добавить страницу</h1>
@stop

@section('content')
    {!! Form::open()->multipart()->url(route('admin.pages.store')) !!}
    @include('admin.page._form')
    {!!Form::submit("Сохранить")!!}
    {!! Form::close() !!}
@stop
