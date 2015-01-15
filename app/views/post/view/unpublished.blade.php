@extends('layouts.full')

@section('title')Preview &mdash; {{ $post->getTitle() }} &mdash; {{ $site->getTitle() }} @stop

@section('content')
    <article class="view-article">
        <h1 class="article-header">{{{ $post->getTitle() }}}</h1>
        <h2 class="article-footer">{{{ $post->getPublishDate() ? $post->getPublishDate()->format('F jS, Y') : 'No Date' }}}</h2>

        <div class="article-content">
            {{ $post->getHtml() }}
        </div>

    </article>
@stop
