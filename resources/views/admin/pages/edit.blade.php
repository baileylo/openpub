@extends('admin.layouts.master')

@section('title')Edit Page &mdash; {{ $page->title }} @stop

@section('content-header')
    <h1>
        Edit Page
        <small>{{ $page->title }}</small>
    </h1>
    <ol class="breadcrumb">
        <li>Content</li>
        <li><a href="{{ route('admin.page.index') }}">Page</a></li>
        <li><a href="{{ route('admin.page.edit', $page->slug) }}" class="active">Edit</a></li>
    </ol>
@stop

@section('content')
    @include('admin.pages.form', ['action' => route('admin.page.update', $page->slug), 'page' => $page, 'method' => 'PUT'])
@stop
