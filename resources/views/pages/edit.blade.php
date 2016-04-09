@extends('layouts.full')

@section('title')Edit &mdash; {{ $page->title }} @stop

@section('content')
    <form action="{{ route('page.update', $page->slug) }}" method="POST">
        <input type="hidden" name="_method" value="PUT" />
        {!! csrf_field() !!}

        @if ($status)
            <div class="row">
                <div class="large-12 columns">
                    <div class="alert-box success text-center">Page {{ ucwords($status) }}!</div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="large-12 columns @if($errors->has('title')) error @endif">
                <input type="text" id="title" name="title" placeholder="Title: Name of the post" required value="{{ old('title', $page->title) }}">
                @if($errors->has('title'))
                    <small class="error">{{ $errors->first('title') }}</small>
                @endif
            </div>
        </div>

        <div class="row collapse">
            <div class="small-3 large-2 columns">
                <span class="prefix">{{ route('resource', '') }}/</span>
            </div>
            <div class="small-9 large-10 columns @if($errors->has('slug')) error @endif">
                <input type="text" id="slug" name="slug" placeholder="Slug: url used to redirect" required value="{{ old('slug', $page->slug) }}">
                @if($errors->has('slug'))
                    <small class="error">{{ $errors->first('slug') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="small-2 columns">
                <label for="template" class="right inline">Template</label>
            </div>
            <div class="small-10 columns">
                <select name="template" id="template">
                    @foreach($templates as $template)
                        <option value="{{ $template }}">{{ ucwords($template) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns @if($errors->has('body')) error @endif">
                <textarea name="body" id="body" cols="30" rows="15" placeholder="Post: Body of the post written in Markdown" required="true">{!! old('body', $page->is_html ? $page->html : $page->markdown) !!}</textarea>
                @if($errors->has('body'))
                    <small class="error">{{ $errors->first('body') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="large-3 columns">
                <div class="clear-fix">
                    <div class="left small">
                        <label for="markdown-toggle" title="Enable markdown parsing of body.">Markdown:</label>
                    </div>
                    <div class="switch round tiny right">
                        <input id="markdown-toggle" type="checkbox" name="is_markdown" value="yes" @if(!$page->is_html) checked @endif>
                        <label for="markdown-toggle">Markdown Enabled</label>
                    </div>
                </div>
            </div>
            <div class="large-9 columns text-right">
                <a class="button alert" href="{{ route('page.index') }}">Cancel</a>
                <button type="submit" class="success">Save</button>
            </div>
        </div>
    </form>
@stop
