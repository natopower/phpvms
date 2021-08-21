@extends('auth.login_layout')
@section('title', __('Reset Password'))

<!-- Main Content -->
@section('content')
<div class="container">
  <div class="col-md-8 ml-auto mr-auto content-center">
    <div class="card mt-5">
      <div class="card-header p-1"><h5 class="m-1 p-0">{{ __('Reset Password') }}</h5></div>
      <div class="card-body p-1">
        @if (session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
          {{ csrf_field() }}
          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">{{ __('Email Address') }}</label>
            <div class="col">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
                <span class="form-text"><strong>{{ $errors->first('email') }}</strong></span>
              @endif
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary float-right">{{ __('Send Password Reset Link') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
