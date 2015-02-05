@extends('layouts.full')

@section('title') {{ $page->getTitle() }} &mdash; {{ $site->getTitle() }} @stop

@section('content')
    <article>
        {{ $page->getHtml() }}
    </article>
@stop
