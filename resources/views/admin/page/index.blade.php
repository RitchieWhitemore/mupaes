<?php
/**
 * @var $page \App\Models\Page
 */
?>

@extends('adminlte::page')

@section('title', 'Страницы')

@section('content_header')
    <h1>Страницы</h1>
@stop

@section('content')
    <p><a href="{{ route('admin.pages.create') }}" class="btn btn-success">Добавить страницу</a></p>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Категория</th>
            <th>Наименование</th>
            <th>Псевдоним</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->getCategoryName() }}</td>
                <td><a href="{{ route('admin.pages.show', $page) }}">{{ $page->name }}</a></td>
                <td>{{ $page->slug }}</td>
                <td class="action-column">
                    <a href="{{route('admin.pages.show', $page)}}" title="Просмотр" aria-label="Просмотр">
                        <i class="far fa-eye"></i></a>
                    <a href="{{route('admin.pages.edit', $page)}}" title="Редактировать"
                       aria-label="Редактировать">
                        <i class="fas fa-pen"></i></a>
                    {!! Form::open()->route('admin.pages.destroy', [$page])->method('delete')->attrs(['class' => 'pull-right admin-delete-form']) !!}
                    {!! Form::submit('<i class="fas fa-times"></i>')->attrs(['data-confirm' => 'Вы уверены?']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
