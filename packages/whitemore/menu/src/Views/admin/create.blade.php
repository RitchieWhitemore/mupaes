@extends('adminlte::page')

@section('title', 'Добавить элемент меню')

@section('content_header')
    <h1>Добавить элемент меню</h1>
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
    {!! Form::open()->multipart()->url(route('menu.store')) !!}
    @include('menu::admin._form')
    {!!Form::submit("Сохранить")!!}
    {!! Form::close() !!}
@stop
