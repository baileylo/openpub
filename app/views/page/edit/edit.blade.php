@extends('layouts.full')

@section('title')Page Publisher &mdash; {{ $site->getTitle() }} @stop

@section('footer')@stop

@section('content')
    {{ Form::open(['id' => 'create-post']) }}
    <div class="row">
        <div class="large-12 columns @if($errors->has('title')) error @endif">
            {{ Form::text('title', $page->getTitle(), ['placeholder' => 'Title: Use in the browser title', 'required' => true]) }}
            @if($errors->has('title'))
                <small class="error">{{{ $errors->first('title') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns @if($errors->has('slug')) error @endif">
            {{ Form::text('slug', $page->getSlug(), ['placeholder' => 'Slug: URL safe page identifier', 'required' => true]) }}
            @if($errors->has('slug'))
                <small class="error">{{{ $errors->first('slug') }}}</small>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns @if($errors->has('html')) error @endif">
            {{ Form::textarea('html', $page->getHtml(), ['class' => 'hide', 'id' => 'create-page-page']) }}
            <div class="code-editor-wrapper">
                <div id="editor" class="code-editor"> {{{ $page->getHtml() }}}
                </div>
            </div>

            @if($errors->has('html'))
                <small class="error">{{{ $errors->first('html') }}}</small>
            @endif
        </div>
    </div>
    <div class="row hidden-for-small-down">
        <div class="columns large-12 medium-12 text-right">
            @if ($page->isPublished())
                {{ Form::button('Update Page', ['type' => 'submit']) }}
            @else
                {{ Form::button('Publish', ['type' => 'submit', 'class' => 'success', 'name' => 'isPublished', 'value' => 'yes']) }}
                {{ Form::button('Save', ['type' => 'submit', 'name' => 'isPublished', 'value' => 'no']) }}
            @endif
        </div>
    </div>
    <div class="row visible-for-small-down">
        <div class="columns small-12">
            @if ($page->isPublished())
                {{ Form::button('Update Page', ['type' => 'submit', 'class' => 'expand']) }}
            @else
                {{ Form::button('Publish', ['type' => 'submit', 'class' => 'success expand', 'name' => 'isPublished', 'value' => 'yes']) }}
                {{ Form::button('Save', ['type' => 'submit', 'name' => 'isPublished', 'class' => 'expand', 'value' => 'no']) }}
            @endif
        </div>
    </div>
    {{ Form::close() }}
@stop

@section('js')
    <script src="/js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/js/vendor/jquery.resize.js"></script>
    <script type="text/javascript" src="/js/page-editor.js"></script>
@stop
