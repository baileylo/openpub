<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', $site->getTitle())</title>

    <link rel="alternate" type="application/rss+xml" title="Infectious Learning &raquo; Feed" href="{{ route('feed.atom') }}" />

    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600italic,600,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/normalize.css"/>
    <link rel="stylesheet" href="/css/foundation.css"/>
    <link rel="stylesheet" href="/css/custom.css"/>
</head>

<body>

    @yield('tophat')

    <header class="row" id="page-header">
        @yield('header')
    </header>

    <section class="row">
        <div class="columns large-9 large-centered">
            @yield('content')
        </div>
    </section>

    <footer class="row">
        <div class="columns large-9 large-centered">
            @yield('footer')
        </div>
    </footer>

    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/vendor/modernizr.js"></script>
    <script src="/js/foundation.min.js"></script>
    <script src="/js/foundation/foundation.topbar.js"></script>

    <script>
        $(document).foundation();
    </script>
</body>

</html>
