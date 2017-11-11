@extends('admin.layouts.single')

@section('title', 'Login')

@section('css')
    <style>
        html, body { height:100%; margin:0; padding:0 }
        .row-fluid { height: 100%; display:table-cell; vertical-align: middle; }

        .container-fluid {
            height:100%;
            display:table;
            width: 100%;
            padding: 0;
        }

        .centering {
            float:none;
            margin:0 auto;
        }
    </style>
@endsection

@section('content')
    <div class="row-fluid">
        <div class="col-md-4 text-center centering">
            <img src="/img/profile@2x.jpg" alt="Logan Bailey" class="img-thumbnail" width="150">
            <h3>Welcome To OpenPub!</h3>
            <p>The markdown based blogging platform.</p>
            <p>Login to begin managing your blog.</p>

            <form action="{{ route('login') }}" method="POST" name="login">
                {!! csrf_field() !!}
                <div class="form-group @if($errors->has('email')) has-error @endif">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <span class="help-block danger">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group @if($errors->has('password')) has-error @endif">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-key fa-fw" aria-hidden="true"></i>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <span class="help-block danger">{{ $errors->first('password') }}</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fa fa-caret-square-o-right"></i>
                        login
                    </button>
                </div>
                <p><a href="#">Forgot password?</a></p>
            </form>
        </div>
    </div>
@stop
