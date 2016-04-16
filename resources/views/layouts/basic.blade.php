<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="alternate" type="application/atom+xml" title="Logan Bailey &mdash; Adventures In Web Development" href="{{ route('feed') }}" />

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
</head>

<body>

    @yield('tophat')

    <header class="row" id="page-header">
        @yield('header')
    </header>

    <section class="row">
        <div class="columns large-10 large-centered">
            @yield('content')
        </div>
    </section>

    @yield('footer')

    <script src="{{ elixir('js/app.js') }}"></script>

    @if (Auth::user())
        <script>
            $(document).foundation();
        </script>
    @endif

    @yield('js')
</body>

</html>
