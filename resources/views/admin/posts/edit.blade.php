@extends('admin.layouts.master')

@section('title')Edit &mdash; {{ $post->title }} @stop

@section('content-header')
    <h1>
        Edit Post
        <small>{{ $post->title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>Content</li>
        <li><a href="{{ route('admin.post.index') }}">Post</a></li>
        <li><a href="{{ route('admin.post.edit', $post->slug) }}" class="active">Edit</a></li>
    </ol>
@stop

@section('content')
    @include('admin.posts.form', ['action' => route('admin.post.update', $post->slug), 'post' => $post, 'method' => 'PUT'])
@stop