<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', $site->getTitle())</title>
    <meta name=viewport content="width=device-width, initial-scale=1">

    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="{{ $site->getTitle() }}" />
    
    @section('ogp')
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:title" content="{{ $site->getTitle() }}" />
        <meta property="og:description" content="{{ $site->getDescription() }}" />
    @show

    <link rel="alternate" type="application/atom+xml" title="{{ $site->getTitle() }}" href="{{ route('feed') }}" />
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
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

    @yield('js')

    @if ($site->getGoogleAnalyticsId())
        <script type="text/javascript">
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', '{{  $site->getGoogleAnalyticsId() }}', 'auto');
            ga('send', 'pageview');
        </script>
    @endif
</body>

</html>
