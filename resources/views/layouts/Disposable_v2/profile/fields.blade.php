<table class="table table-sm table-striped table-borderless mb-0">
  <tr>
    <td>@lang('common.name')</td>
    <td>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('name') ? ' has-danger' : '' }}">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        @if ($errors->has('name'))<p class="form-text text-danger">{{ $errors->first('name') }}</p>@endif
      </div>
    </td>
  </tr>
  <tr>
    <td>@lang('common.email')</td>
    <td>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('email') ? ' has-danger' : '' }}">
        {{ Form::text('email', null, ['class' => 'form-control']) }}
        @if ($errors->has('email'))<p class="form-text text-danger">{{ $errors->first('email') }}</p>@endif
      </div>
    </td>
  </tr>
  <tr>
    <td>
      Discord ID 
      <a href="https://support.discord.com/hc/en-us/articles/206346498-Where-can-I-find-my-User-Server-Message-ID-" target="_blank">
        <i class="fas fa-question-circle ml-2" title="How to find your ID"></i>
      </a>
    </td>
    <td>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('discord_id') ? ' has-danger' : '' }}">
        {{ Form::text('discord_id', null, ['class' => 'form-control']) }}
        @if ($errors->has('discord_id')) <p class="form-text text-danger">{{ $errors->first('discord_id') }}</p>@endif
      </div>
    </td>
  </tr>
  @if(Theme::getSetting('change_airline'))
    <tr>
      <td>@lang('common.airline')</td>
      <td>
        <div class="form-group input-group-sm mb-1 {{ $errors->has('airline') ? ' has-danger' : '' }}">
          @php asort($airlines); @endphp
          {{ Form::select('airline_id', $airlines, null , ['style' => 'width: 100%', 'class' => 'form-control select2']) }}
          @if ($errors->has('airline_id'))<p class="form-text text-danger">{{ $errors->first('airline_id') }}</p>@endif
        </div>
      </td>
    </tr>
  @else
    {{ Form::hidden('airline_id', $user->airline_id, false) }}
  @endif

  @if(Theme::getSetting('change_hub'))
    <tr>
      <td>@lang('airports.home')</td>
      <td>
        <div class="form-group input-group-sm mb-1 {{ $errors->has('home_airport_id') ? ' has-danger' : '' }}">
          {{ Form::select('home_airport_id', $airports, null , ['style' => 'width: 100%', 'class' => 'form-control select2']) }}
          @if ($errors->has('home_airport_id'))<p class="form-text text-danger">{{ $errors->first('home_airport_id') }}</p>@endif
        </div>
      </td>
    </tr>
  @else
    {{ Form::hidden('home_airport_id', $user->home_airport_id, false) }}
  @endif
  <tr>
    <td>@lang('common.country')</td>
    <td>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('country') ? ' has-danger' : '' }}">
        {{ Form::select('country', $countries, null, ['style' => 'width: 100%', 'class' => 'form-control select2' ]) }}
        @if ($errors->has('country'))<p class="form-text text-danger">{{ $errors->first('country') }}</p>@endif
      </div>
    </td>
  </tr>
  <tr>
    <td>@lang('common.timezone')</td>
    <td>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('timezone') ? ' has-danger' : '' }}">
        {{ Form::select('timezone', $timezones, null, ['style' => 'width: 100%', 'class' => 'form-control select2' ]) }}
        @if ($errors->has('timezone'))<p class="form-text text-danger">{{ $errors->first('timezone') }}</p>@endif
      </div>
    </td>
  </tr>
  <tr>
    <td>@lang('profile.changepassword')</td>
    <td>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('password') ? ' has-danger' : '' }}">
        <label for="password">@lang('profile.newpassword'):</label>
        {{ Form::password('password', ['class' => 'form-control']) }}
        @if ($errors->has('password'))<p class="form-text text-danger">{{ $errors->first('password') }}</p>@endif
      </div>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
        <label for="password_confirmation">@lang('passwords.confirm'):</label>
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
        @if ($errors->has('password_confirmation')) <p class="form-text text-danger">{{ $errors->first('password_confirmation') }}</p>@endif
      </div>
    </td>
  </tr>
  <tr>
    <td>@lang('profile.avatar')</td>
    <td>
      <div class="form-group input-group-sm mb-1 {{ $errors->has('avatar') ? ' has-danger' : '' }}">
        {{ Form::file('avatar', null) }}
        <p class="form-text m-1">@lang('profile.avatarresize', ['width' => config('phpvms.avatar.width'),'height' => config('phpvms.avatar.height')])</p>
        @if ($errors->has('avatar')) <p class="form-text text-danger">{{ $errors->first('avatar') }}</p> @endif
      </div>
    </td>
  </tr>
  {{-- Custom fields --}}
  @foreach($userFields as $field)
    <tr>
      <td>{{ $field->description }} @if($field->required === true) <span class="text-danger">*</span> @endif</td>
      <td>
        <div class="form-group input-group-sm mb-1">
          {{ Form::text('field_'.$field->slug, $field->value, ['class' => 'form-control']) }}
          <p class="form-text text-danger">{{ $errors->first('field_'.$field->slug) }}</p>
        </div>
      </td>
    </tr>
  @endforeach
  <tr>
    <td>@lang('profile.opt-in')</td>
    <td>
      <div class="form-group mb-1">
        {{ Form::hidden('opt_in', 0, false) }}
        {{ Form::checkbox('opt_in', 1, null) }}
        <p class="form-text m-1">@lang('profile.opt-in-descrip')</p>
      </div>
    </td>
  </tr>
</table>
<div class="text-right">
  {{ Form::submit(__('profile.updateprofile'), ['class' => 'btn btn-sm btn-primary m-1 p-1']) }}
</div>
