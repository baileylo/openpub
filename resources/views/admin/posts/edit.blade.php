@extends('admin.layouts.master')

@section('title')Edit &mdash; {{ $post->title }} @stop

@section('content')
    <section class="col-lg-12">
        <div class="row">
            <header class="col-lg-12 page-header">
                <h1>
                    Edit Post
                    <small>{{ $post->title }}</small>
                </h1>
                <ol class="breadcrumb">
                    <li>Content</li>
                    <li><a href="{{ route('admin.post') }}">Post</a></li>
                    <li><a href="{{ route('admin.post.edit', $post->slug) }}" class="active">Edit</a></li>
                </ol>
            </header>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('admin.posts.form', ['action' => route('admin.post.update', $post->slug), 'post' => $post])
            </div>
        </div>
    </section>
@stop
