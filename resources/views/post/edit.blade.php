@extends('layouts.full')

@section('title')Edit &mdash; {{ $post->title }} @stop

@section('content')
    <form action="{{ route('post.update', $post->slug) }}" method="POST">
        <input type="hidden" name="_method" value="PUT" />
        {!! csrf_field() !!}

        @if ($status)
            <div class="row">
                <div class="large-12 columns">
                    <div class="alert-box success text-center">Post {{ ucwords($status) }}!</div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="large-12 columns @if($errors->has('title')) error @endif">
                <input type="text" id="title" name="title" placeholder="Title: Name of the post" required value="{{ old('title', $post->title) }}">
                @if($errors->has('title'))
                    <small class="error">{{ $errors->first('title') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns @if($errors->has('categories')) error @endif">
                <input type="text" name="categories" value="{{ old('categories', $post->categories->pluck('name')->implode(', ')) }}" placeholder="Categories: Insert as many as you want separated by a coma" required />
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
                        <option value="{{ $template }}" @if ($post->template === $template) selected @endif>{{ ucwords($template) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns @if($errors->has('description')) error @endif">
                <textarea name="description" id="description" cols="30" rows="2" placeholder="Description: Short description used in OGP" required>{{ old('description', $post->description) }}</textarea>
                @if($errors->has('description'))
                    <small class="error">{{ $errors->first('description') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns @if($errors->has('body')) error @endif">
                <textarea name="body" id="body" cols="30" rows="15" placeholder="Post: Body of the post written in Markdown" required="true">{!! old('body', $post->is_html ? $post->html : $post->markdown) !!}</textarea>
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
                        <input id="markdown-toggle" type="checkbox" name="is_markdown" value="yes" @if(!$post->is_html) checked @endif>
                        <label for="markdown-toggle">Markdown Enabled</label>
                    </div>
                </div>
            </div>

            <div class="large-9 columns text-right">
                <a class="button alert" href="{{ route('admin') }}">Cancel</a>
                @if (!$post->is_published)
                    <button type="submit" name="isPublished" value="yes">Save &amp; Publish</button>
                @endif

                <button type="submit" name="isPublished" value="yes" class="success">Update</button>
            </div>
        </div>
    </form>
@stop
