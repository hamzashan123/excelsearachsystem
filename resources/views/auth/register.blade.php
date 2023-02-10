@extends('layouts.app')
@section('title', 'Registration')
@section('content')
<h4 class="fw-300 c-grey-900 mB-40">
    {{ trans('global.register') }}
</h4>
@if(\Session::has('message'))
    <p class="alert alert-info">
        {{ \Session::get('message') }}
    </p>
@endif

                                 <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first_name" class="text-small text-uppercase">{{ __('First Name') }}</label>
                                                <input id="first_name" type="text" class="form-control form-control-lg" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                                                @error('first_name')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="last_name" class="text-small text-uppercase">{{ __('Last Name') }}</label>
                                                <input id="last_name" type="text" class="form-control form-control-lg" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                                @error('last_name')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                      
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email" class="text-small text-uppercase">{{ __('E-Mail Address') }}</label>
                                                <input id="email" type="email" class="form-control form-control-lg" value="{{ old('email') }}" name="email" placeholder="Enter your Email">
                                                @error('email')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password" class="text-small text-uppercase">{{ __('New Password') }}</label>
                                                <input id="password" type="password" class="form-control form-control-lg" name="password" placeholder="Enter your password">
                                                @error('password')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-confirm" class="text-small text-uppercase">{{ __('Confirm Password') }}</label>
                                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm Password">
                                                @error('password-confirm')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label text-small" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-dark">
                                            {{ __('Register') }}
                                        </button>
                                        @if(Route::has('login'))
                                            <a class="btn btn-link text-small" href="{{ route('login') }}">
                                                {{ __('Login?') }}
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
