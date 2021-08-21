<table class="table table-sm table-striped table-borderless mb-0 text-center">
  <th class="text-left"></th>
  @if(Theme::getSetting('roster_ident'))
    <th class="text-left">@lang('flights.callsign')</th>
  @endif
  <th class="text-left">@lang('common.name')</th>
  <th>@lang('common.country')</th>
  <th>@lang('DisposableAirlines::common.base')</th>
  <th>@lang('DisposableAirlines::common.location')</th>
  <th>{{ trans_choice('common.flight', 2) }}</th>
  <th>{{ trans_choice('common.hour', 2) }}</th>
  @if(setting('pilots.allow_transfer_hours') === true)
    <th>@lang('DisposableAirlines::common.transfer')</th>
  @endif
  @if(Theme::getSetting('total_hours'))
    <th>@lang('DisposableAirlines::common.thours')</th>
  @endif
  <th>@lang('DisposableAirlines::common.rank')</th>
  <th>@lang('DisposableAirlines::common.awards')</th>
  @if(!setting('pilots.hide_inactive'))
    <th>@lang('common.status')</th>
  @endif
  @if(Theme::getSetting('roster_ivao'))
    <th>IVAO</th>
  @endif
  @if(Theme::getSetting('roster_vatsim'))
    <th>VATSIM</th>
  @endif
  @if(Theme::getSetting('roster_poscon'))
    <th>POSCON</th>
  @endif
  @foreach($users as $user)
    <tr>
      <td class="text-left align-middle">
        @if ($user->avatar == null)
          <img class="rounded img-h50 border border-dark" src="{{ public_asset('/disposable/nophoto.jpg') }}"/>
        @else
          <img class="rounded img-h50 border border-dark" src="{{ $user->avatar->url }}">
        @endif
      </td>
      @if(Theme::getSetting('roster_ident'))
        <td class="text-left align-middle">
          <a href="{{ route('frontend.profile.show', [$user->id]) }}">{{ $user->ident }}</a>
        </td>
      @endif
      <td class="text-left align-middle">
        <a href="{{ route('frontend.profile.show', [$user->id]) }}">{{ $user->name_private }}</a>
      </td>
      <td class="align-middle">
        @if(filled($user->country))
          <span class="p-0 m-0 flag-icon flag-icon-{{ strtolower($user->country) }}" title="{{ $country->alpha2($user->country)['name'] }}" style="font-size: 1.5rem;"></span>
        @endif
      </td>
      <td class="align-middle">
        @if($user->home_airport)
          @if($disphubs)
            <a href="{{ route('DisposableHubs.hshow', [$user->home_airport_id]) }}" title="{{ $user->home_airport->name ?? '' }}">
          @else
            <a href="{{ route('frontend.airports.show', [$user->home_airport_id]) }}" title="{{ $user->home_airport->name ?? '' }}">
          @endif
            {{ $user->home_airport_id }}
          </a>
        @endif
      </td>
      <td class="align-middle">
        @if($user->current_airport)
          <a href="{{route('frontend.airports.show', [$user->curr_airport_id])}}" title="{{ $user->current_airport->name ?? '' }}">{{ $user->curr_airport_id }}</a>
        @endif
      </td>
      <td class="align-middle">{{ $user->flights }}</td>
      <td class="align-middle">
        @minutestotime($user->flight_time)
      </td>
      @if(setting('pilots.allow_transfer_hours') === true)
        <td class="align-middle">
          @minutestohours($user->transfer_time)h
        </td>
      @endif
      @if(Theme::getSetting('total_hours'))
        <td class="align-middle">
          @minutestotime($user->flight_time + $user->transfer_time)
        </td>
      @endif
      <td class="align-middle">
        @if(filled($user->rank->image_url))
          <img class="rounded img-mh30" src="{{ $user->rank->image_url }}" title="{{ $user->rank->name }}">
        @else
          {{ $user->rank->name }}
        @endif
      </td>
      <td class="align-middle">
        @if ($user->awards->count() > 0)
          <i class="fas fa-trophy fa-lg" style="color: darkgreen;" title="{{ $user->awards->count() }} @lang('DisposableAirlines::common.awards')"></i>
        @endif
      </td>
      @if(!setting('pilots.hide_inactive'))
        <td class="align-middle">{!! Dispo_UserStateBadge($user->state) !!}</td>
      @endif
      @if(Theme::getSetting('roster_ivao'))
        <td class="align-middle">
          @foreach($user->fields->whereNotNull('value') as $field)
            @if($field->field->name === 'IVAO')
              <a href='https://www.ivao.aero/Member.aspx?ID={{ $field->value }}' target='_blank'><b>{{ $field->value }}</b></a>
            @endif
          @endforeach
        </td>
      @endif
      @if(Theme::getSetting('roster_vatsim'))
        <td class="align-middle">
          @foreach($user->fields->whereNotNull('value') as $field)
            @if($field->field->name === 'VATSIM')
              <a href='https://stats.vatsim.net/search_id.php?id={{ $field->value }}' target='_blank'><b>{{ $field->value }}</b></a>
            @endif
          @endforeach
        </td>
      @endif
      @if(Theme::getSetting('roster_poscon'))
        <td class="align-middle">
          @foreach($user->fields->whereNotNull('value') as $field)
            @if($field->field->name === 'POSCON')
              <b>{{ $field->value }}</b>
            @endif
          @endforeach
        </td>
      @endif
    </tr>
  @endforeach
</table>
