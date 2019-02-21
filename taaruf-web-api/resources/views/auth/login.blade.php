@extends('layouts.app', ['title' => 'Login'])

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-4 offset-4">
            <div class="login-brand">
                {{config('app.name')}}
            </div>

            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header"><h4>Login</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email">Alamat Email</label>

                            <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ old('email') }}" required autofocus>
                            <div class="invalid-feedback">
                                Harap isi email Anda
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="d-block">Kata Sandi
{{--                                 <div class="float-right">
                                    <a href="{{ route('password.request') }}">
                                        Lupa Kata Sandi?
                                    </a>
                                </div>
 --}}                            </label>

                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                Harap isi kata sandi Anda
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox float-left">
                                <input type="checkbox" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }} tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Remember Me</label>
                            </div>
                            <div class="float-right">
                                <a href="{{url('/password/reset')}}">Lupa Kata Sandi?</a>
                            </div>
                        </div>

                        

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary btn-block" tabindex="4">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="simple-footer">
                Copyright &copy; {{config('app.name')}} {{date('Y')}}
            </div>
        </div>
    </div>
</div>

@stop