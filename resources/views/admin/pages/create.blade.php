@extends('admin.layouts.master')

@section('title')Write Page @stop

@section('content-header')
    <h1>Write Page</h1>
    <ol class="breadcrumb">
        <li>Content</li>
        <li><a href="{{ route('admin.page.index') }}">Page</a></li>
        <li><a href="{{ route('admin.page.create') }}" class="active">Write</a></li>
    </ol>
@stop

@section('content')
    @include('admin.pages.form', ['action' => route('admin.page.store'), 'page' => new \App\Article\Page()])
@stop
