<?php
/**
 * @var $model \App\Models\Page
 */
?>

@extends('adminlte::page')

@section('title', 'Редактировать страницу')

@section('content_header')
    <h1>Редактировать страницу</h1>
@stop

@section('content')
    {!! Form::open()->multipart()->route('admin.pages.update', [$model])->method('put')->fill($model) !!}
    @include('admin.page._form')
    {!!Form::submit("Сохранить")!!}
    {!! Form::close() !!}
@stop
