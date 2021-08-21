@extends('auth.login_layout')
@section('title', __('Reset Password'))

@section('content')
<div class="container">
    <div class="col-md-8 col-md-offset-2">
      <div class="card">
        <div class="card-header p-1"><h5 class="m-1 p-0">{{ __('Reset Password') }}</h5></div>
        <div class="card-body">
          {{ Form::open(['url' => url('/password/reset'), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal',]) }}
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">{{ __('Email Address') }}</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                @if ($errors->has('email')) <span class="form-text"><strong>{{ $errors->first('email') }}</strong></span> @endif
              </div>
          </div>
          <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">{{ __('Password') }}</label>
            <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>
              @if ($errors->has('password')) <span class="form-text"><strong>{{ $errors->first('password') }}</strong></span> @endif
            </div>
          </div>
          <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm" class="col-md-4 control-label">{{ __('Confirm Password') }}</label>
            <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              @if ($errors->has('password_confirmation')) <span class="form-text"><strong>{{ $errors->first('password_confirmation') }}</strong></span> @endif
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary float-right">{{ __('Reset Password') }}</button>
          </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
</div>
@endsection
