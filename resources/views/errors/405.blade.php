@extends('layouts.full')

@section('title')Page Not Found &mdash; {{ $site->getTitle() }} @stop


@section('content')
    <h1>Sorry!</h1>
    <p>We're not setup to handle your request right now.</p>
@stop
