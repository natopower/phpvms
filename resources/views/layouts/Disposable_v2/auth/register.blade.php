@extends('auth.login_layout')
@section('title', __('auth.register'))

@section('content')
<div class="col-md-8 ml-auto mr-auto content-center">
  {{ Form::open(['url' => '/register', 'class' => 'form-signin']) }}
  <div class="card mt-4">
    <div class="card-header p-1">
      <h4 class="m-1 p-0">@lang('common.register')</h4>
    </div>
    <div class="card-body p-1">
      <div class="form-group form-group-no-border {{ $errors->has('name') ? 'has-danger' : '' }}">
        <label for="name" class="control-label">@lang('auth.fullname')</label>
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        @if ($errors->has('name')) <p class="form-text text-danger">{{ $errors->first('name') }}</p>  @endif
      </div>
      <div class="form-group form-group-no-border {{ $errors->has('email') ? 'has-danger' : '' }}">
        <label for="email" class="control-label">@lang('auth.emailaddress')</label>
        {{ Form::text('email', null, ['class' => 'form-control']) }}
        @if ($errors->has('email')) <p class="form-text text-danger">{{ $errors->first('email') }}</p> @endif
      </div>
      <div class="form-group form-group-no-border {{ $errors->has('password') ? 'has-danger' : '' }}">
        <label for="password" class="control-label">@lang('auth.password')</label>
        {{ Form::password('password', ['class' => 'form-control']) }}
        @if ($errors->has('password')) <p class="form-text text-danger">{{ $errors->first('password') }}</p> @endif
      </div> 
      <div class="form-group form-group-no-border {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
        <label for="password_confirmation" class="control-label">@lang('passwords.confirm')</label>
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        @if ($errors->has('password_confirmation')) <p class="form-text text-danger">{{ $errors->first('password_confirmation') }}</p> @endif
      </div>
      <hr>
      <div class="form-group form-group-no-border {{ $errors->has('airline') ? 'has-danger' : '' }}">
        <label for="airline" class="control-label">@lang('common.airline')</label>
        {{ Form::select('airline_id', $airlines, null , ['class' => 'form-control select2']) }}
        @if ($errors->has('airline_id')) <p class="form-text text-danger">{{ $errors->first('airline_id') }}</p>  @endif
      </div>
      <div class="form-group form-group-no-border {{ $errors->has('home_airport') ? 'has-danger' : '' }}">
        <label for="home_airport" class="control-label">@lang('airports.home')</label>
        {{ Form::select('home_airport_id', $airports, null , ['class' => 'form-control select2']) }}
        @if ($errors->has('home_airport_id')) <p class="form-text text-danger">{{ $errors->first('home_airport_id') }}</p> @endif
      </div>
      <div class="form-group form-group-no-border {{ $errors->has('country') ? 'has-danger' : '' }}">
        <label for="country" class="control-label">@lang('common.country')</label>
        {{ Form::select('country', $countries, null, ['class' => 'form-control select2' ]) }}
        @if ($errors->has('country')) <p class="form-text text-danger">{{ $errors->first('country') }}</p> @endif
      </div>
      <div class="form-group form-group-no-border {{ $errors->has('timezone') ? 'has-danger' : '' }}">
        <label for="timezone" class="control-label">@lang('common.timezone')</label>
        {{ Form::select('timezone', $timezones, null, ['id'=>'timezone', 'class' => 'form-control select2' ]) }}
        @if ($errors->has('timezone')) <p class="form-text text-danger">{{ $errors->first('timezone') }}</p> @endif
      </div>
      @if (setting('pilots.allow_transfer_hours') === true)
        <div class="form-group form-group-no-border {{ $errors->has('transfer_time') ? 'has-danger' : '' }}">
          <label for="transfer_time" class="control-label">@lang('auth.transferhours')</label>
          {{ Form::number('transfer_time', 0, ['class' => 'form-control']) }}
          @if ($errors->has('transfer_time')) <p class="form-text text-danger">{{ $errors->first('transfer_time') }}</p> @endif
        </div>
      @endif
      @if($userFields)
        @foreach($userFields as $field)
          <div class="form-group form-group-no-border {{ $errors->has('field_'.$field->slug) ? 'has-danger' : '' }}">
            <label for="field_{{ $field->slug }}" class="control-label">{{ $field->description }}</label>
            {{ Form::text('field_'.$field->slug, null, ['class' => 'form-control']) }}
            @if ($errors->has('field_'.$field->slug)) <p class="form-text text-danger">{{ $errors->first('field_'.$field->slug) }}</p> @endif
          </div>
        @endforeach
      @endif
      @if(config('captcha.enabled'))
        <div class="form-group form-group-no-border {{ $errors->has('g-recaptcha-response') ? 'has-danger' : '' }}">
          <label for="g-recaptcha-response" class="control-label">@lang('auth.fillcaptcha')</label>
          {!! NoCaptcha::display(config('captcha.attributes')) !!}
          @if ($errors->has('g-recaptcha-response')) <p class="form-text text-danger">{{ $errors->first('g-recaptcha-response') }}</p> @endif
        </div>
      @endif
      <hr>
      <div>@include('auth.toc')</div>
      <table>
        <tr>
          <td style="vertical-align: top; padding: 5px 10px 0 0">
            <div class="form-group form-group-no-border">
              {{ Form::hidden('toc_accepted', 0, false) }}
              {{ Form::checkbox('toc_accepted', 1, null, ['id' => 'toc_accepted']) }}
            </div>
          </td>
          <td style="vertical-align: top;">
            <label for="toc_accepted" class="control-label">@lang('auth.tocaccept')</label>
            @if ($errors->has('toc_accepted')) <p class="form-text text-danger">{{ $errors->first('toc_accepted') }}</p> @endif 
          </td>
        </tr>
        <tr>
          <td>
            <div class="form-group form-group-no-border">
              {{ Form::hidden('opt_in', 0, false) }}
              {{ Form::checkbox('opt_in', 1, null) }}
            </div>
          </td>
          <td>
            <label for="opt_in" class="control-label">@lang('profile.opt-in-descrip')</label>
          </td>
        </tr>
      </table>
      <div class="text-right pt-5">{{ Form::submit(__('auth.register'), ['id' => 'register_button', 'class' => 'btn btn-primary', 'disabled' => true, ]) }}</div>
    </div>
  </div>
  {{ Form::close() }}
</div>
@endsection
@section('scripts')
  {!! NoCaptcha::renderJs(config('app.locale')) !!}
  <script>
    $('#toc_accepted').click(function () {
      if ($(this).is(':checked')) {
        console.log('toc accepted');
        $('#register_button').removeAttr('disabled');
      } else {
        console.log('toc not accepted');
        $('#register_button').attr('disabled', 'true');
      }
    });
  </script>
@endsection
