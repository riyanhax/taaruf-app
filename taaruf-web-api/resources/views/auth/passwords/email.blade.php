@extends('layouts.app', ['title' => 'Lupa Password'])

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-4 offset-4">
            <div class="card pl-3 pr-3 pb-3">
                <div class="login-brand">
                    <a href="{{ url('/home') }}"><b>{{config('app.name')}}</b></a>
                </div>

                <!-- /.login-logo -->
                <div class="login-box-body">
                    <p class="login-box-msg">Enter Email to reset password</p>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
                <!-- /.login-box-body -->
            </div>
        </div>
    </div>
</div>
<!-- /.login-box -->
@stop