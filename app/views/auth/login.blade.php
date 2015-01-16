@extends('layouts.full')

@section('title')Login &mdash; {{ $site->getTitle() }} @stop

@section('footer')@stop

@section('content')

{{ Form::open() }}
    <div class="row">
        <div class="columns large-6 large-centered">
            <div class="row">
                <div class="small-3 columns">
                    {{ Form::label('login', 'Login', ['class' => 'right inline']) }}
                </div>
                <div class="small-9 columns">
                    <label @if($errors->has('login')) class="error"@endif>
                        {{ Form::text('login') }}
                        @if ($errors->has('login'))
                            <small class="error">{{{ $errors->first('login') }}}</small>
                        @endif
                    </label>

                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    {{ Form::label('password', 'Password', ['class' => 'right inline']) }}
                </div>
                <div class="small-9 columns">
                    <label @if($errors->has('password')) class="error"@endif>
                        {{ Form::password('password') }}
                        @if ($errors->has('password'))
                            <small class="error">{{{ $errors->first('password') }}}</small>
                        @endif
                    </label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="button small success">Login</button>
            </div>
        </div>
    </div>
{{ Form::close() }}
@stop
