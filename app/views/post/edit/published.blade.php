@extends('layouts.full')

@section('title')Edit &mdash; {{ $post->getTitle() }} &mdash; {{ $site->getTitle() }} @stop

@section('footer')@stop

@section('content')
    {{ Form::open(['method' => 'put']) }}
    <div class="row">
        <div class="large-12 columns @if($errors->has('title')) error @endif">
            {{ Form::text('title', $post->getTitle(), ['placeholder' => 'Title: Name of the post', 'required' => true]) }}
            @if($errors->has('title'))
                <small class="error">{{{ $errors->first('title') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns @if($errors->has('categories')) error @endif">
            {{ Form::text('categories', implode(', ', array_map(function($category) { return $category->getName(); }, $post->getCategories()->toArray())), ['placeholder' => 'Categories: Insert as many as you want separated by a coma', 'required' => true]) }}
            @if($errors->has('categories'))
                <small class="error">{{{ $errors->first('categories') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns @if($errors->has('description')) error @endif">
            {{ Form::textarea('description', $post->getDescription(), ['placeholder' => 'Description: Short description used in OGP', 'required' => true, 'rows' => 2]) }}
            @if($errors->has('description'))
                <small class="error">{{{ $errors->first('description') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns @if($errors->has('body')) error @endif">
            {{ Form::textarea('body', $post->getMarkdown(), ['placeholder' => 'Post: Body of the post written in Markdown', 'required' => true, 'rows' => 15]) }}
            @if($errors->has('body'))
                <small class="error">{{{ $errors->first('body') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns text-right">
            <a class="button alert" href="{{ route('admin') }}">Cancel</a>
            {{ Form::button('Update', ['type' => 'submit', 'class' => 'success']) }}
        </div>
    </div>
    {{ Form::close() }}
@stop
