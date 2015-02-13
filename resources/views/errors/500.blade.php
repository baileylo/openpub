@extends('layouts.full')

@section('title')Oh Snap! &mdash; {{ $site->getTitle() }} @stop


@section('content')
    <h1>Oh Snap!</h1>
    <p>Our server encountered an error, hopefully we'll fix it soon.</p>
@stop
