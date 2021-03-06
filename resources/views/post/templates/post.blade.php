@extends('layouts.full')

@section('title', $article->title)

@section('ogp')
    @include('partials.ogp', ['article' => $article])
@stop

@section('twitter-card')
    @include('partials.twitter-card', ['article' => $article])
@stop

@section('content')
    <article class="view-article">
        <div class="page-header">
            <h1>
                {{ $article->title }}
                <small>
                    @if ($article->published_at)
                        Posted on {{ $article->published_at->format('F jS, Y') }}
                    @else
                        This post hasn't been published
                    @endif
                </small>
            </h1>
        </div>

        <div class="article-content">
            {!! $article->html !!}
        </div>

        <div class="categories">
            <h6>Posted In:</h6>
            @foreach($article->categories as $category)
                <a href="{{ route('category', $category) }}" class="btn-primary btn-sm">{{ $category->name }}</a>
            @endforeach
        </div>

    </article>

    @include('partials.json-ld', ['article' => $article])
@stop

@section('js')
    <script src="{{ elixir('js/highlight.js') }}" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="{{ elixir('css/highlight.css') }}"/>
    <script>hljs.initHighlightingOnLoad();</script>
@stop
