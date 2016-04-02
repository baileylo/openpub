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
            <div class="large-12 columns @if($errors->has('slug')) error @endif">
                <input type="text" id="slug" name="slug" placeholder="Slug: url used to redirect" required value="{{ old('slug') }}">
                @if($errors->has('slug'))
                    <small class="error">{{ $errors->first('slug') }}</small>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns @if($errors->has('body')) error @endif">
                <textarea name="body" id="body" cols="30" rows="2" placeholder="Body: The html for the page" required>{{ old('body') }}</textarea>
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
