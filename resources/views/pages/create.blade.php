@extends('layouts.full')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('page.store') }}" method="POST">
        {!! csrf_field() !!}

        <div class="row">
            <div class="large-12 columns @if($errors->has('title')) error @endif">
                <input type="text" id="title" name="title" placeholder="Title: Name of the page" required value="{{ old('title') }}">
                @if($errors->has('title'))
                    <small class="error">{{ $errors->first('title') }}</small>
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

        <div class="row collapse">
            <div class="small-3 large-2 columns">
                <span class="prefix">{{ route('resource', '') }}/</span>
            </div>
            <div class="small-9 large-10 columns @if($errors->has('slug')) error @endif">
                <input type="text" id="slug" name="slug" placeholder="Slug: url used to redirect" required value="{{ old('slug') }}">
                @if($errors->has('slug'))
                    <small class="error">{{ $errors->first('slug') }}</small>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns @if($errors->has('body')) error @endif">
                <textarea name="body" id="body" cols="30" rows="2" placeholder="Body: The markdown for the page" required>{{ old('body') }}</textarea>
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
                        <input id="markdown-toggle" type="checkbox" name="is_markdown" value="yes">
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

