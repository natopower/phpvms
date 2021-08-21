@extends('auth.login_layout')
@section('title', __('common.login'))

@section('content')
<div class="col-5 my-auto ml-auto mr-auto content-center">
  @if(Theme::getSetting('login_logo'))
    <div class="card mt-3 mb-2 text-center bg-transparent border-0 shadow-none">
      <a href="/"><img src="{{ public_asset('/disposable/phpvms_emblem.svg') }}" class="rounded"></a>
    </div>
  @endif
  {{ Form::open(['url' => url('/login'), 'method' => 'post', 'class' => 'form']) }}
    <div class="card mt-3 mb-2">
      <div class="card-body p-1">
        <div class="input-group form-group-no-border {{ $errors->has('email') ? ' has-error' : '' }} input-lg mb-2">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          {{ Form::text('email', old('email'), ['id' => 'email', 'placeholder' => __('common.email').' '.__('common.or').' '.__('common.pilot_id'), 'class' => 'form-control', 'required' => true]) }}
          @if ($errors->has('email')) <span class="form-text"><strong>{{ $errors->first('email') }}</strong></span>@endif
        </div>
        <div class="input-group form-group-no-border {{ $errors->has('password') ? ' has-error' : '' }} input-lg">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
          </div>
          {{ Form::password('password', ['name' => 'password', 'class' => 'form-control', 'placeholder' => __('auth.password'), 'required' => true]) }}
          @if ($errors->has('password')) <span class="form-text"><strong>{{ $errors->first('password') }}</strong></span>@endif
        </div>
      </div>
      <div class="card-footer text-center p-1">
        <button class="btn btn-primary btn-round btn-block">@lang('common.login')</button>
      </div>
      <div class="card-footer p-1">
        <span class="float-left">
          <h6 class="m-0 p-0"><a href="{{ url('/register') }}">@lang('auth.createaccount')</a></h6>
        </span>
        <span class="float-right">
          <h6 class="m-0 p-0"><a href="{{ url('/password/reset') }}">@lang('auth.forgotpassword')?</a></h6>
        </span>
      </div>
    </div>
  {{ Form::close() }}
</div>
@endsection
