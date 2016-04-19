<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <link rel="alternate" type="application/atom+xml" title="Logan Bailey &mdash; Adventures In Web Development" href="{{ route('feed') }}" />
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
</head>

<body>

    @yield('tophat')

    <header class="container-fluid masthead">
        @yield('header')
    </header>

    <section class="container">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                @yield('content')
            </div>
        </div>
    </section>

    @yield('footer')

    {{--<script src="{{ elixir('js/app.js') }}"></script>--}}

    {{--@if (Auth::user())--}}
        {{--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">--}}
        {{--<script>--}}
            {{--$(document).foundation();--}}
        {{--</script>--}}
    {{--@endif--}}

    @yield('js')
</body>

</html>
