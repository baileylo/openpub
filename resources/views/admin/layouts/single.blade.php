@extends('admin.layouts.base')

@section('head')
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="alternate" type="application/atom+xml" title="Logan Bailey &mdash; Adventures In Web Development" href="{{ route('feed') }}" />
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
    @yield('css')

    <link href='//fonts.googleapis.com/css?family=Gill+Sans' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-hQpvDQiCJaD2H465dQfA717v7lu5qHWtDbWNPvaTJ0ID5xnPUlVXnKzq7b8YUkbN" crossorigin="anonymous">
@endsection

@section('body')
    <section class="container-fluid">
        @yield('content')
    </section>
    @yield('js')
@endsection
