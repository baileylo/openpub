@extends('layouts.full')

@section('title')Import &mdash; Admin &mdash; {{ $site->getTitle() }} @stop

@section('content')
    <h4>Import WP XML</h4>
    <p>
        Add instructions here on generating an XML dump.
    </p>
    Aite, lets get some shit done here...

    {{ Form::open(['files' => true]) }}
        {{ Form::file('xml', ['required' => true]) }}
        {{ Form::submit('Import', ['class' => 'button']) }}
    {{ Form::close() }}
@stop

@section('footer') @stop
