@extends('layouts.full')

@section('title', 'Update Page &mdash; Admin')

@section('content')
    @if ($status)
        <div class="row">
            <div class="large-12 columns">
                <div class="alert-box success text-center">Page {{ ucwords($status) }}!</div>
            </div>
        </div>
    @endif

    <form action="{{ route('page.update', $page->slug) }}" method="POST">
        <input type="hidden" name="_method" value="PUT" />
        {!! csrf_field() !!}

        <div class="row">
            <div class="large-12 columns @if($errors->has('title')) error @endif">
                <input type="text" id="title" name="title" placeholder="Title: Name of the page" required value="{{ old('title', $page->title) }}">
                @if($errors->has('title'))
                    <small class="error">{{ $errors->first('title') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns @if($errors->has('slug')) error @endif">
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
                <textarea name="body" id="body" cols="30" rows="8" placeholder="Body: The html for the page" required>{{ old('body', $page->body) }}</textarea>
                @if($errors->has('body'))
                    <small class="error">{{ $errors->first('body') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns text-right">
                <a class="button alert" href="{{ route('pages.index') }}">Cancel</a>
                <button type="submit" class="success">Save</button>
            </div>
        </div>
    </form>
@stop
