@extends('layouts.full')

@section('title') {{ $post->title }} &mdash;  @stop

@section('content')
    <article class="view-article">
        <h1 class="article-header">{{ $post->title }}</h1>
        @if ($post->published_at)
            <h2 class="article-footer">Posted on {{ $post->published_at->format('F jS, Y') }}</h2>
        @else
            <h2 class="article-footer">This post hasn't been published</h2>
        @endif

        <div class="article-content">
            {!! $post->html !!}
        </div>

        <div class="categories">
            <h6>Posted In:</h6>
            @foreach($post->categories as $category)
                <a href="#" class="button tiny round">{{ $category->name }}</a>
            @endforeach
        </div>

    </article>
@stop

@section('js')
    <script src="/js/highlight.pack.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="/css/highlight/github.css"/>
    <script>hljs.initHighlightingOnLoad();</script>
@stop
