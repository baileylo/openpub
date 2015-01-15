@extends('layouts.basic')

@section('tophat')
    @if(Auth::user())
        @include('partials.tophat', ['user' => Auth::user()])
    @endif
@stop

@section('header')
<nav class="columns large-7 large-centered" style="margin-top:75px;">
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
