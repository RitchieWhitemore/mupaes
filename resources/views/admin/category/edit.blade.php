@extends('adminlte::page')

@section('title', 'Редактировать категорию')

@section('content_header')
    <h1>Редактировать категорию</h1>
@stop

@section('content')
    {!! Form::open()->multipart()->route('admin.categories.update', [$category])->method('put')->fill($category) !!}
    @include('admin.category._form')
    {!!Form::submit("Сохранить")!!}
    {!! Form::close() !!}
@stop
