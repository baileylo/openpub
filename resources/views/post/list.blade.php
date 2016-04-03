@extends('layouts.full')

@section('title') @if(isset($category)) {{ $category->name }}@endif @stop

@section('content')

    @if(isset($category))
        <h2>Posts Tagged With {{ $category->name }}</h2>
    @endif

    @foreach($posts as $post)
        <article class="list-article">
            <h3 class="article-header"><a href="{{ route('resource', $post->slug) }}">{{ $post->title }}</a></h3>

            <div class="article-content">
                {{ $post->description }}
            </div>

            <h6 class="subheader article-footer">{{ $post->published_at->format('F jS, Y') }}</h6>
        </article>
    @endforeach

    @include('pagination.simple', ['paginator' => $posts])

@stop
