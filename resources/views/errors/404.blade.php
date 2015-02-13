@extends('layouts.full')

@section('title')Page Not Found &mdash; {{ $site->getTitle() }} @stop


@section('content')
    <h1>Sorry!</h1>
    <p>We're not quite sure what you were looking for.</p>
@stop
