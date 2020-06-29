@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('page', $page))

@section('content')
    <section class="col-12">
        <h1 class="title">{{$page->name}}</h1>
        <div class="content">
            {!! $page->text !!}
        </div>
    </section>
@endsection
