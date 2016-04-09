@extends('layouts.full')

@section('title', 'Login')

@section('content')
<form method="POST">
    {!! csrf_field() !!}
    <div class="row">
        <div class="columns large-6 medium-6 small-12 large-centered medium-centered small-centered">
            <div class="row">
                <div class="columns large-3 medium-3 hidden-for-small-down">
                    <label for="login" class="right inline">Login</label>
                </div>
                <div class="columns large-9 medium-9 small-12 ">
                    <label @if($errors->has('login')) class="error"@endif>
                        <input type="text" id="login" name="email" placeholder="login" required="true" />
                        @if ($errors->has('email'))
                            <small class="error">{{ $errors->first('email') }}</small>
                        @endif
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="columns large-3 medium-3 hidden-for-small-down">
                    <label for="password" class="right inline">Password</label>
                </div>
                <div class="columns large-9 medium-9 small-12">
                    <label @if($errors->has('password')) class="error"@endif>
                        <input type="password" name="password" id="password" placeholder="Password" required="true" />
                        @if ($errors->has('password'))
                            <small class="error">{{ $errors->first('password') }}</small>
                        @endif
                    </label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="button small success expand">Login</button>
            </div>
        </div>
    </div>
</form>
@stop
