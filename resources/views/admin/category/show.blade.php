<?php
/**
 * @var $category \App\Models\Category
 */
?>

@extends('adminlte::page')

@section('title', 'Просмотр категории')

@section('content_header')
    <h1>Просмотр категории</h1>
@stop

@section('content')
    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary mr-1">Редактировать</a>
        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="mr-1">
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
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Родитель</th>
                    <td>{{ $category->getParentName() }}</td>
                </tr>
                <tr>
                    <th>Название</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Название меню</th>
                    <td>{{ $category->menu_name }}</td>
                </tr>
                <tr>
                    <th>Псевдоним</th>
                    <td>{{ $category->slug }}</td>
                </tr>
                <tr>
                    <th>Изображение</th>
                    <td>
                        @if ($src = $category->getFirstMediaUrl('images', 'thumb-admin'))
                            <img src="{{$src}}">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Текст</th>
                    <td class="html-viewer">{!! Purifier::clean($category->text); !!}</td>
                </tr>
                <tr>
                    <th>Скрыто</th>
                    <td>{{ $category->hidden }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>SEO</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                    <th>Meta title</th>
                    <td>{{ $category->meta_title }}</td>
                </tr>
                <tr>
                    <th>Meta description</th>
                    <td>{{ $category->meat_description }}</td>
                </tr>
                <tr>
                    <th>Meta keywords</th>
                    <td>{{ $category->meta_keywords }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
