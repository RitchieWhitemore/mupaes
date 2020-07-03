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
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::open()->multipart()->route('menu.update', [$model])->method('put')->fill($model) !!}
    @include('menu::admin._form')
    {!!Form::submit("Сохранить")!!}
    {!! Form::close() !!}
@stop
