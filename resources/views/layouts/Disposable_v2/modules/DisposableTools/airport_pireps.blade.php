@php if(Route::currentRouteName() === 'DisposableHubs.hshow') {$hubroute = true;} else {$hubroute = false;} @endphp
<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">{{ trans_choice('common.pirep',2) }}<i class="fas fa-upload float-right"></i></h5>
  </div>
  <div class="card-body p-0 overflow-auto">
    @if(!$pireps->count())
      <span class="text-center m-1">@lang('DisposableTools::common.nothing')</span>
    @else
      <table class="table table-sm table-striped table-borderless mb-0 text-center">
        <tr>
          <th class="text-left">@lang('pireps.flightident')</th>
          <th>@lang('common.departure')</th>
          <th>@lang('common.arrival')</th>
          <th>@lang('common.aircraft')</th>
          <th>@lang('pireps.flighttime')</th>
          <th>{{ trans_choice('common.pilot',1) }}</th>
        </tr>
        @foreach($pireps as $pirep)
          <tr>
            <td class="text-left">{{ $pirep->airline->iata ?? $pirep->airline->icao }} {{ $pirep->ident }}</td>
            <td>
              @if($config['location'] != $pirep->dpt_airport_id)<a href="{{ route('frontend.airports.show', [$pirep->dpt_airport_id]) }}">@endif
                {{ $pirep->dpt_airport_id }} @if($hubroute){{ $pirep->dpt_airport->name ?? '' }}@endif
              @if($config['location'] != $pirep->dpt_airport_id)</a>@endif
            </td>
            <td>
              @if($config['location'] != $pirep->arr_airport_id)<a href="{{ route('frontend.airports.show', [$pirep->arr_airport_id]) }}">@endif
                {{ $pirep->arr_airport_id }} @if($hubroute){{ $pirep->arr_airport->name ?? '' }}@endif
              @if($config['location'] != $pirep->arr_airport_id)</a>@endif
            </td>
            <td>
              @if($pirep->aircraft && Dispo_Modules('DisposableAirlines'))
                <a href="{{ route('DisposableAirlines.daircraft', [$pirep->aircraft->registration ?? '']) }}">{{ $pirep->aircraft->registration ?? '' }} ({{ $pirep->aircraft->icao ?? '' }})</a>
              @elseif($pirep->aircraft)
                {{ $pirep->aircraft->registration ?? '' }} ({{ $pirep->aircraft->icao ?? '' }})
              @endif
            </td>
            <td>@minutestotime($pirep->flight_time)</td>
            <td><a href="{{ route('frontend.users.show.public', [$pirep->user_id]) }}">{{ $pirep->user->name_private ?? 'Deleted User'}}</a></td>
          </tr>
        @endforeach
      </table>
    @endif
  </div>
  <div class="card-footer p-1 text-right">
    <span class="m-0 p-0">@lang('DisposableTools::common.total') : {{ number_format($pireps->count()) }}</span>
  </div>
</div>
