<?php
/**
 * @var $model \Whitemore\Menu\Models\Menu
 */
?>

@extends('adminlte::page')

@section('title', 'Просмотр элемента меню')

@section('content_header')
    <h1>Просмотр элемента меню</h1>
@stop

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('menu.edit', $model) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('menu.destroy', $model) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Удалить</button>
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Основные</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $model->id }}</td>
                </tr>
                <tr>
                    <th>Родитель</th>
                    <td>{{ $model->getParentTitle() }}</td>
                </tr>
                <tr>
                    <th>Название</th>
                    <td>{{ $model->title }}</td>
                </tr>
                <tr>
                    <th>Псевдоним</th>
                    <td>{{ $model->slug }}</td>
                </tr>
                <tr>
                    <th>Скрыто</th>
                    <td>{{ $model->getHiddenValue() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
