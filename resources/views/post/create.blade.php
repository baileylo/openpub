@extends('layouts.full')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="POST">
        {!! csrf_field() !!}

        <div class="row">
            <div class="large-12 columns @if($errors->has('title')) error @endif">
                <input type="text" id="title" name="title" placeholder="Title: Name of the post" value="{{ old('title') }}">
                @if($errors->has('title'))
                    <small class="error">{{ $errors->first('title') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns @if($errors->has('categories')) error @endif">
                <input type="text" name="categories" value="{{ old('categories') }}" placeholder="Categories: Insert as many as you want separated by a coma" />
                @if($errors->has('categories'))
                    <small class="error">{{ $errors->first('categories') }}</small>
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
            <div class="large-12 columns @if($errors->has('description')) error @endif">
                <textarea name="description" id="description" cols="30" rows="2" placeholder="Description: Short description used in OGP">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <small class="error">{{ $errors->first('description') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns @if($errors->has('body')) error @endif">
                <textarea name="body" id="body" cols="30" rows="15" placeholder="Post: Body of the post written in Markdown">{!! old('body') !!}</textarea>
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
                        <input id="markdown-toggle" type="checkbox" name="is_markdown" value="yes" checked>
                        <label for="markdown-toggle">Markdown Enabled</label>
                    </div>
                </div>
            </div>
            <div class="large-9 columns text-right">
                <a class="button alert" href="{{ route('admin') }}">Cancel</a>
                <button type="submit" name="isPublished" value="yes">Save &amp; Publish</button>
                <button type="submit" name="isPublished" value="no" class="success">Save</button>
            </div>
        </div>
    </form>
@stop
