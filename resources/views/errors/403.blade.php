@extends('layouts.full')

@section('title')403 Forbidden &mdash; {{ $site->getTitle() }} @stop


@section('content')
    <h1>Sorry!</h1>
    <p>It looks like you're trying to access something you shouldn't be.</p>
@stop
