@extends('layouts.basic')

@section('header')
    <div class="row">
        <div class="default-view col-md-12 text-center visible-md-block visible-sm-block visible-lg-block">
            <div class="visible-md-inline-block visible-sm-inline-block visible-lg-block image-wrapper">
                <img src="/img/profile@2x.jpg" alt="Logan Bailey" class="img-thumbnail" width="150">
            </div>
            <div class="visible-md-inline-block visible-sm-inline-block visible-lg-block">
                <h1>Adventures In Web Development</h1>
                <p>
                    <a href="{{ route('home') }}" title="blog">Blog</a>,
                    <a href="{{ route('resource', 'about-me') }}">About</a>,
                    <a href="https://github.com/baileylo" target="_blank">GitHub</a>, and
                    <a href="https://www.linkedin.com/in/loganbailey" target="_blank">LinkedIn</a>
                </p>
            </div>
        </div>
        <div class="col-xs-12 visible-xs-block mobile-view">
            <a href="{{ route('home') }}">
                <img src="/img/profile@2x.jpg" alt="Logan Bailey" class="img-circle" width="35">
            </a>
            <h1>
                <a href="{{ route('home') }}">Adventures In Web Development</a>
            </h1>
        </div>
    </div>
@stop

@section('footer')
    <div class="row">
        <div class="col-xs-7 col-xs-push-5 col-md-2 col-md-push-5">
            <div class="footer-content">
                <ul class="list-unstyled">
                    <li class="heading">Follow Me</li>
                    <li><a href="https://twitter.com/baileylo" target="_blank">Twitter</a></li>
                    <li><a href="https://github.com/baileylo" target="_blank">GitHub</a></li>
                </ul>
            </div>
        </div>
    </div>
@stop
