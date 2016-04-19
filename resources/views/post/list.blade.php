@extends('layouts.full')

@section('title')@if(isset($category)) {{ $category->name }} &mdash;@endif Logan Bailey @stop

@section('content')

    @if(isset($category))
        <div class="page-header">
            <h3> {{ $category->name }}</h3>
        </div>
    @endif

    @foreach($posts as $post)
        <article class="list-article">
            <h3 class="article-header"><a href="{{ route('resource', $post->slug) }}">{{ $post->title }}</a></h3>
            <h6 class="subheader">{{ $post->published_at->format('F jS, Y') }}</h6>

            <div class="article-content">
                {{ $post->description }}
            </div>
        </article>
    @endforeach
    {!! $posts->links() !!}
@stop
