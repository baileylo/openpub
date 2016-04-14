@extends('layouts.full')

@section('title', 'Edit Settings')

@section('content')
    <form action="{{ route('settings') }}" method="POST" class="row">
        <input type="hidden" name="_method" value="PUT" />
        {!! csrf_field() !!}

        <div class="large-10 columns large-offset-1">
            <h3>Settings</h3>
            <hr>

            <div class="row">
                <div class="large-2 columns">
                    <label class="right inline" for="name">Name</label>
                </div>
                <div class="large-10 columns">
                    <input type="text" id="name" name="name" @if($errors->has('name')) class="error" @endif placeholder="John Doe" value="{{ old('name', $user->name) }}" required/>

                    @if ($errors->has('name'))
                        <small class="error">{{ $errors->first('name') }}</small>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="large-2 columns">
                    <label class="right inline" for="email">Email</label>
                </div>
                <div class="large-10 columns">
                    <input type="email" id="email" name="email" @if($errors->has('email')) class="error" @endif placeholder="name@domain.tld" value="{{ old('email', $user->email) }}" required/>

                    @if ($errors->has('email'))
                        <small class="error">{{ $errors->first('email') }}</small>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="large-2 columns">
                    <label class="right inline" for="password">Password</label>
                </div>
                <div class="large-10 columns">
                    <input type="password" id="password" name="password" @if($errors->has('password')) class="error" @endif />

                    @if ($errors->has('password'))
                        <small class="error">{{ $errors->first('password') }}</small>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="large-10 large-offset-2 columns">
                    <input type="submit" class="button radius success small" value="Update Settings"/>
                </div>
            </div>
        </div>
    </form>
@stop
