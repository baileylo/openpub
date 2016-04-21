extends('admin.layouts.base')

@section('head')
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="alternate" type="application/atom+xml" title="Logan Bailey &mdash; Adventures In Web Development" href="{{ route('feed') }}" />
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
    <link href='//fonts.googleapis.com/css?family=Gill+Sans' rel='stylesheet' type='text/css'>
@endsection

@section('body')
    <header class="container-fluid masthead">
        @yield('header')
    </header>

    <section class="container-fluid page-content">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                @yield('content')
            </div>
        </div>
    </section>

    <footer class="container-fluid footer">
        @yield('footer')
    </footer>

    @yield('js')
@endsection
