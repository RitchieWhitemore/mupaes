@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('category', $category))

@section('content')
    <div class="col-12">
        <h1 class="title text-center">{{$category->name}}</h1>
    </div>
    <div class="col-12 content">
        @if (!empty($pages))
            <ul class="document__list">
                @foreach($pages as $item)
                    <li class="document__item">
                        <a href="{{route('page', [$category->slug, $item->slug])}}">{{$item->name}}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
