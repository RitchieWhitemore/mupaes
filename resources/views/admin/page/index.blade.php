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

    {!! grid([
    'dataProvider' => $dataProvider,
    'rowsPerPage' => 20,
    'columns' => [
        'page_id',
        [
            'class' => 'attribute',
            'title' => 'Категория',
            'value' => 'category_name',
            'filter' => [
                'class' => 'dropdown',
                'name' => 'category_id',
                'items' => \App\Models\Category::getCategoriesForDropdown()->toArray(),
]
],
        'page_name',
        'page_slug',
        [
            'class' => 'actions',
            'value' => [
                'edit:/admin/pages/{page_id}/edit',
                'view:/admin/pages/{page_id}',
                'delete:/admin/pages/{page_id}',
            ]
        ]
    ],
]) !!}
@stop
