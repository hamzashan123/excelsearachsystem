@extends('layouts.app')
@section('content')

@if(\Session::has('message'))
    <p class="alert alert-info">
        {{ \Session::get('message') }}
    </p>
@endif

<form method="POST" action="{{ route('login') }}" class="loginform">
    <h4 class="fw-300 c-grey-900 mB-40 ">
        <b>{{ trans('global.login') }}</b>
    </h4>
    {{ csrf_field() }}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-user"></i>
            </span>
        </div>
        <input name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
        @if($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
        </div>
        <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
        @if($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
    </div>

    <div class="input-group mb-4">
        <div class="col-6 form-check checkbox">
            <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />
            <label class="form-check-label" for="remember" style="vertical-align: middle;">
                {{ trans('global.remember_me') }}
            </label>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-link px-0" href="{{ route('register') }}">
                Don't have an account?
            </a>

        </div>
        
        
    </div>

    <div class="row">
        <div class="col-6">
            <button type="submit" class="btn btn-success px-4">
                {{ trans('global.login') }}
            </button>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                {{ trans('global.forgot_password') }}
            </a>

        </div>
    </div>
</form>
@endsection
