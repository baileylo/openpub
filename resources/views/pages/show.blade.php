@extends('layouts.full')

@section('title', $page->title)

@section('content')
    <article class="view-article">
        {!! $page->body !!}
    </article>
@stop
