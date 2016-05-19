@extends('admin.layouts.master')

@section('title', 'Edit Settings')

@section('content-header')
    <h1>Settings</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.post.index') }}" class="active">Account Settings</a></li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.settings') }}" method="POST" class="form-inverse">
                <input type="hidden" name="_method" value="PUT" />
                {!! csrf_field() !!}

                @if (isset($status) && $status)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success text-center" role="alert">
                                Account {{ ucwords($status) }}!
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row form-group">
                    <div class="col-lg-12 @if($errors->has('name')) has-error @endif">
                        <label for="name">Name: </label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="John Doe" value="{{ old('name', $user->name) }}">
                        @if($errors->has('name'))
                            <small class="help-block">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-12 @if($errors->has('email')) has-error @endif">
                        <label for="email">Email: </label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="name@domain.tld" value="{{ old('email', $user->email) }}">
                        @if($errors->has('email'))
                            <small class="help-block">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-12 @if($errors->has('password')) has-error @endif">
                        <label for="password">Password: </label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                        @if($errors->has('password'))
                            <small class="help-block">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10 col-lg-offset-2 text-right">
                        <input type="submit" class="btn btn-success" value="Update Settings"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
