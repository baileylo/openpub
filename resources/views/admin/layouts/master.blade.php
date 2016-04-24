@extends('admin.layouts.base')

@section('head')
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="alternate" type="application/atom+xml" title="Logan Bailey &mdash; Adventures In Web Development" href="{{ route('feed') }}" />
    <link rel="stylesheet" href="{{ elixir('css/admin.css') }}"/>

    @yield('css')

    {{--<link href='//fonts.googleapis.com/css?family=Gill+Sans' rel='stylesheet' type='text/css'>--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-hQpvDQiCJaD2H465dQfA717v7lu5qHWtDbWNPvaTJ0ID5xnPUlVXnKzq7b8YUkbN" crossorigin="anonymous">
@endsection

@section('body')
    <!-- Content -->
    <div class="container-fluid">
        <div class="row">
            @include('admin.partials.sidenav')
            <div class="col-sm-10 main-content">

                <div class="row topbar">
                    @include('admin.partials.topnav')
                </div>

                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    @yield('js')
@endsection
