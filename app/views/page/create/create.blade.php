@extends('layouts.full')

@section('title')Page Publisher &mdash; {{ $site->getTitle() }} @stop

@section('footer')@stop

@section('content')
    {{ Form::open(['id' => 'create-post']) }}
    <div class="row">
        <div class="large-12 columns @if($errors->has('title')) error @endif">
            {{ Form::text('title', null, ['placeholder' => 'Title: HTML Page title', 'required' => true]) }}
            @if($errors->has('title'))
                <small class="error">{{{ $errors->first('title') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns @if($errors->has('slug')) error @endif">
            {{ Form::text('slug', null, ['placeholder' => 'Slug: URL safe page identifier', 'required' => true]) }}
            @if($errors->has('slug'))
                <small class="error">{{{ $errors->first('slug') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns @if($errors->has('body')) error @endif">
            {{ Form::textarea('page', null, ['class' => 'hide', 'id' => 'create-page-page']) }}
            <div class="code-editor-wrapper">
                <div id="editor" class="code-editor"></div>
            </div>

            @if($errors->has('body'))
                <small class="error">{{{ $errors->first('body') }}}</small>
            @endif
        </div>
    </div>
    <div class="row hidden-for-small-down">
        <div class="columns large-12 medium-12 text-right">
            {{ Form::button('Publish', ['type' => 'submit', 'class' => 'success', 'name' => 'isPublished', 'value' => 'yes']) }}
            {{ Form::button('Save', ['type' => 'submit', 'name' => 'isPublished', 'value' => 'no']) }}
        </div>
    </div>
    <div class="row visible-for-small-down">
        <div class="columns small-12">
            {{ Form::button('Publish', ['type' => 'submit', 'class' => 'success expand', 'name' => 'isPublished', 'value' => 'yes']) }}
            {{ Form::button('Save', ['type' => 'submit', 'name' => 'isPublished', 'class' => 'expand', 'value' => 'no']) }}
        </div>
    </div>
    {{ Form::close() }}
@stop

@section('js')
    <script src="/js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/js/vendor/jquery.resize.js"></script>
    <script type="text/javascript" src="/js/page-editor.js"></script>
@stop
