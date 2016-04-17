<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>Error Occurred</title>
    <link rel="alternate" type="application/atom+xml" title="Logan Bailey &mdash; Adventures In Web Development" href="{{ route('feed') }}" />
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
</head>

<body>


<header class="row" id="page-header">
    <nav class="columns large-7 medium-11 medium-centered large-centered show-for-medium-up" style="margin-top:75px;">
        <div class="button-bar">
            <ul class="header-button-group button-group">
                <li><a class="small button" href="http://logansbailey.com" title="Home">Home</a></li>
                <li><a class="small button" href="http://logansbailey.com/about-me" title="About Me">About Me</a></li>
                <li class="nav-bar-item-logo">
                    <div class="nav-bar-logo-container">
                        <img src="/img/profile.png" width="125px"/>
                    </div>
                </li>
                <li><a class="small button" href="https://github.com/baileylo/" target="_blank" title="GitHub">GitHub</a></li>
                <li><a class="small button" href="https://www.linkedin.com/in/loganbailey/" title="LinkedIn" target="_blank">LinkedIn</a></li>
            </ul>
        </div>
    </nav>
    <nav class="top-bar show-for-small-down" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1>
                    <a href="http://logansbailey.com">
                        <img src="/img/profile.png" width="35px"/>
                        Infectious Learning
                    </a>
                </h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section"> <!-- Right Nav Section -->
            <ul class="right">
                <li><a href="#" title="About Me">About Me</a></li>
                <li><a href="https://github.com/baileylo/" target="_blank" title="GitHub">GitHub</a></li>
                <li><a href="https://www.linkedin.com/in/loganbailey/" title="LinkedIn" target="_blank">LinkedIn</a></li>

            </ul>
        </section>
    </nav>

</header>

<section class="row">
    <div class="columns large-9 large-centered">
        <h1>Sorry!</h1>
        <p>We're not quite sure what you were looking for.</p>
    </div>
</section>


<script src="{{ elixir('js/app.js') }}"></script>

@if (Auth::user())
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script>
        $(document).foundation();
    </script>
@endif

</body>

</html>
