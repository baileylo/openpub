@extends('layouts.full')

@section('content')
<article class="view-article">
    <h1 class="article-header">{{{ $post->getTitle() }}}</h1>
    <h2 class="article-footer">{{{ $post->getPublishDate()->format('F jS, Y') }}}</h2>

    <div class="article-content">
        {{ $post->getHtml() }}
    </div>

</article>
@stop
