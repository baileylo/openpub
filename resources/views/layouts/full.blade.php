@extends('layouts.basic')

@section('tophat')
    @if(Auth::user())
        @include('partials.tophat', ['user' => Auth::user()])
    @endif
@stop

@section('header')
    <div class="row">
        <div class="col-xs-12 col-md-12 text-center">
            <img src="/img/profile@2x.jpg" alt="Logan Bailey" class="img-thumbnail" width="150">
            <h1>
                <small>Adventures In Web Development</small>
            </h1>
            <p>
                <a href="{{ route('home') }}" title="blog">Blog</a>,
                <a href="{{ route('resource', 'about-me') }}">About</a>,
                <a href="https://github.com/baileylo" target="_blank">GitHub</a>, and
                <a href="https://www.linkedin.com/in/loganbailey" target="_blank">LinkedIn</a>
            </p>
        </div>
    </div>
@stop

@section('footer')
    <div class="row">
        <div class="col-xs-12 col-md-2 col-md-push-5">
            <div class="footer-content">
                <ul class="list-unstyled">
                    <li class="heading">Follow Me</li>
                    <li><a href="https://twitter.com/baileylo" target="_blank">Twitter</li>
                    <li><a href="https://github.com/baileylo" target="_blank">GitHub</li>
                </ul>
            </div>
        </div>
    </div>
    {{--@if ($site->getGAId())--}}
        {{--<script>--}}
            {{--(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){--}}
                {{--(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),--}}
                    {{--m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)--}}
            {{--})(window,document,'script','//www.google-analytics.com/analytics.js','ga');--}}

            {{--ga('create', '{{ $site->getGAId() }}', 'auto');--}}
            {{--ga('send', 'pageview');--}}

        {{--</script>--}}
    {{--@endif--}}
@stop
