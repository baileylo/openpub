@extends('layouts.full')
@section('footer') @stop

@section('title')Login &mdash; {{ $site->getTitle() }} @stop

@section('footer')@stop

@section('content')

{{ Form::open() }}
    <div class="row">
        <div class="columns large-6 medium-6 small-12 large-centered medium-centered small-centered">
            <div class="row">
                <div class="columns large-3 medium-3 hidden-for-small-down">
                    {{ Form::label('login', 'Login', ['class' => 'right inline']) }}
                </div>
                <div class="columns large-9 medium-9 small-12 ">
                    <label @if($errors->has('login')) class="error"@endif>
                        {{ Form::text('login', null, ['placeholder' => 'Login', 'required' => true]) }}
                        @if ($errors->has('login'))
                            <small class="error">{{{ $errors->first('login') }}}</small>
                        @endif
                    </label>

                </div>
            </div>
            <div class="row">
                <div class="columns large-3 medium-3 hidden-for-small-down">
                    {{ Form::label('password', 'Password', ['class' => 'right inline']) }}
                </div>
                <div class="columns large-9 medium-9 small-12">
                    <label @if($errors->has('password')) class="error"@endif>
                        {{ Form::password('password', ['placeholder' => 'Password', 'required' => true]) }}
                        @if ($errors->has('password'))
                            <small class="error">{{{ $errors->first('password') }}}</small>
                        @endif
                    </label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="button small success expand">Login</button>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop
