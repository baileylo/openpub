@extends('layouts.full')

@section('title') {{ $post->getTitle() }} &mdash; {{ $site->getTitle() }} @stop

@section('content')
<article class="view-article">
    <h1 class="article-header">{{{ $post->getTitle() }}}</h1>
    <h2 class="article-footer">Posted on {{{ $post->getPublishDate()->format('F jS, Y') }}}</h2>

    <div class="article-content">
        {{ $post->getHtml() }}
    </div>

    <div class="categories">
        <h6>Posted In:</h6>
        @foreach($post->getCategories() as $category)
            <span href="#" class="button tiny round">{{{ $category->getName() }}}</span>
        @endforeach
    </div>

</article>
@stop
