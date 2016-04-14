@extends('layouts.full')

@section('title', $article->title)

@section('content')
    <article class="view-article">
        {!! $article->html !!}
    </article>
@stop
