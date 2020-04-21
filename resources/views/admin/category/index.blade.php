@extends('adminlte::page')

@section('title', 'Категории')

@section('content_header')
    <h1>Категории</h1>
@stop

@section('content')
    <p><a href="{{ route('admin.categories.create') }}" class="btn btn-success">Добавить категорию</a></p>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Наименование</th>
            <th>Псевдоним</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a></td>
                <td>{{ $category->slug }}</td>
                <td class="action-column">
                    <a href="{{route('admin.categories.show', $category)}}" title="Просмотр" aria-label="Просмотр">
                        <i class="far fa-eye"></i></a>
                    <a href="{{route('admin.categories.edit', $category)}}" title="Редактировать"
                       aria-label="Редактировать">
                        <i class="fas fa-pen"></i></a>
                    {!! Form::open()->route('admin.categories.destroy', [$category])->method('delete')->attrs(['class' => 'pull-right admin-delete-form']) !!}
                    {!! Form::submit('<i class="fas fa-times"></i>')->attrs(['data-confirm' => 'Вы уверены?']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop