@extends('admin.layouts.master')

@section('title')Write Post @stop

@section('content-header')
    <h1>Write Post</h1>
    <ol class="breadcrumb">
        <li>Content</li>
        <li><a href="{{ route('admin.post.index') }}">Post</a></li>
        <li><a href="{{ route('admin.post.create') }}" class="active">Write</a></li>
    </ol>
@stop

@section('content')
    @include('admin.posts.form', ['action' => route('admin.post.store'), 'post' => new \App\Article\Post()])
@stop
