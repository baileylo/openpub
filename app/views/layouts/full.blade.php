@extends('layouts.basic')

@section('tophat')
    @if(Auth::user())
        @include('partials.tophat', ['user' => Auth::user()])
    @endif
@stop

@section('header')
<nav class="columns large-7 medium-11 medium-centered large-centered show-for-medium-up" style="margin-top:75px;">
    <div class="button-bar">
        <ul class="button-group">
            <li><a class="small button" href="{{ route('home') }}" title="Home">Home</a></li>
            <li><a class="small button" href="#" title="About Me">About Me</a></li>
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
                <a href="{{ route('home') }}">
                    <img src="/img/profile.png" width="35px"/>
                    {{{ $site->getTitle() }}}
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

            @if (Auth::user())
                <li class="divider"></li>
                <li class="has-dropdown">
                    <a href="#" class="show-for-small-down">My Account</a>
                    <a href="#" class="show-for-medium-up">Hello, Logan</a>
                    <ul class="dropdown">
                        <li><a href="{{ route('settings') }}">Settings</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>
        @if (Auth::user())
            <!-- Left Nav Section -->
            <ul class="left">
                <li><a href="{{ route('admin') }}">Admin</a></li>
                <li><a href="{{ route('admin.post.create') }}">Write</a></li>
            </ul>
        @endif
    </section>
</nav>

@stop

@section('footer')
{{--<div class="columns small-4 large-4">--}}
    {{--<h1>Recent Articles</h1>--}}
    {{--<ol>--}}
        {{--<li><a href="#">Object Composition</a></li>--}}
        {{--<li><a href="#">Session User Injection</a></li>--}}
        {{--<li><a href="#">Auto Dependency Resolution Explained</a></li>--}}
        {{--<li><a href="#">Session User Injection</a></li>--}}
    {{--</ol>--}}
{{--</div>--}}
{{--<div class="columns small-4 large-4">--}}

{{--</div>--}}
{{--<div class="columns small-4 large-4">--}}

{{--</div>--}}
@stop
