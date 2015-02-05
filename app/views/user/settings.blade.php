@extends('layouts.full')

@section('title')Settings &mdash; {{ $site->getTitle() }} @stop

@section('content')
    <h1>User Settings</h1>

    <div class="row">
        <div class="columns large-6">
            {{ Form::open(['method' => 'put']) }}
                <fieldset>
                    <legend>Update Information</legend>

                    @if ($settingsUpdated)
                        <div class="alert-box success">User Information Updated!</div>
                    @endif

                    <div class="row @if ($errors->getBag('settings')->has('name')) error @endif">
                        <div class="small-4 columns">
                            {{ Form::label('name', 'Name', ['class' => 'right inline']) }}
                        </div>
                        <div class="small-8 columns">
                            {{ Form::text('name', $user->getName(), ['required' => 1]) }}
                            @if ($errors->getBag('settings')->has('name'))
                                <small class="error">{{{ $errors->getBag('settings')->first('name') }}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row @if ($errors->getBag('settings')->has('email')) error @endif">
                        <div class="small-4 columns">
                            {{ Form::label('email', 'Email', ['class' => 'right inline']) }}
                        </div>
                        <div class="small-8 columns">
                            {{ Form::text('email', $user->getEmail(), ['required' => 1]) }}
                            @if ($errors->getBag('settings')->has('email'))
                                <small class="error">{{{ $errors->getBag('settings')->first('email') }}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="columns large-12">
                            {{ Form::submit('Update', ['class' => 'button tiny']) }}
                        </div>
                    </div>
                </fieldset>
            {{ Form::close() }}
        </div>
        <div class="columns large-6">
            {{ Form::open(['route' => ['passwordHandler'], 'method' => 'put']) }}
                <fieldset>
                    <legend>Change Password</legend>

                    @if ($passwordUpdated)
                        <div class="alert-box success">Password Updated!</div>
                    @endif

                    <div class="row @if ($errors->getBag('password')->has('password')) error @endif">
                        <div class="small-5 columns">
                            {{ Form::label('password', 'New Password', ['class' => 'right inline', 'required' => 1]) }}
                        </div>
                        <div class="small-7 columns">
                            {{ Form::password('password') }}
                            @if ($errors->getBag('password')->has('password'))
                                <small class="error">{{{ $errors->getBag('password')->first('password') }}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-5 columns">
                            {{ Form::label('confirm', 'Confirm', ['class' => 'right inline', 'required' => 1]) }}
                        </div>
                        <div class="small-7 columns">
                            {{ Form::password('password-confirm') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="columns large12">
                            {{ Form::submit('Change Password', ['class' => 'button tiny']) }}
                        </div>
                    </div>
                </fieldset>
            {{ Form::close() }}
        </div>
    </div>
@stop
