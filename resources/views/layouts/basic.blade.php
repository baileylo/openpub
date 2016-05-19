<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Logan Bailey | Adventures in Web Development')</title>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <meta property="fb:app_id" content="33200638" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="Logan Bailey | Adventures in Web Development" />
    
    @section('ogp')
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:title" content="Logan Bailey | Adventures in Web Development" />
        <meta property="og:description" content="Logan S Bailey is a learning magazine, covering topics in web development related to program design, javascript, php and laravel." />
    @show

    <link rel="alternate" type="application/atom+xml" title="Logan Bailey &mdash; Adventures In Web Development" href="{{ route('feed') }}" />
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
    <link href='//fonts.googleapis.com/css?family=Gill+Sans' rel='stylesheet' type='text/css'>
</head>

<body>

    @yield('tophat')

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

    {{--<script src="{{ elixir('js/app.js') }}"></script>--}}
    @yield('js')
</body>

</html>
