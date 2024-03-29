@extends('layouts.app')
@section('content')

@if(\Session::has('message'))
    <p class="alert alert-info">
        {{ \Session::get('message') }}
    </p>
@endif
<form method="POST" action="{{ route('password.email') }}" class="loginform">
    <h4 class="fw-300 c-grey-900 mB-40">
        <b>{{ trans('global.reset_password') }}</b>
    </h4>
    {{ csrf_field() }}
    <p class="text-muted"></p>
    <div>
        {{ csrf_field() }}
        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" required="autofocus" placeholder="{{ trans('global.login_email') }}">
            @if($errors->has('email'))
                <em class="invalid-feedback">
                    {{ $errors->first('email') }}
                </em>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <button type="submit" class="btn btn-success btn-block btn-flat">
                {{ trans('global.reset_password') }}
            </button>
        </div>
    </div>
</form>
@endsection
