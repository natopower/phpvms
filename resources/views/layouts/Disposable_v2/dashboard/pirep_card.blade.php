<div class="card-body p-0">
  <table class="table table-sm table-striped table-borderless mb-0 text-center">
    <tr>
      <th class="text-left">@lang('flights.flightnumber')</th>
      <th class="text-left">@lang('disposable.origin')</th>
      <th class="text-left">@lang('disposable.destination')</th>
      <th>@lang('common.aircraft')</th>
      <th>@lang('pireps.flighttime')</th>
      <th>@lang('disposable.score')</th>
      <th>@lang('disposable.landingrate')</th>
      <th>@lang('pireps.submitted')</th>
      <th>@lang('common.state')</th>
      @if($pirep->state === PirepState::PENDING || $pirep->state === PirepState::DRAFT)
        <th>&nbsp;</th>
      @endif
    </tr>
    <tr>
      <td class="text-left">
        <a href="{{ route('frontend.pireps.show', [$pirep->id]) }}">{{ $pirep->airline->code }} {{ $pirep->ident }}</a>
      </td>
      <td class="text-left">
        <a href="{{ route('frontend.airports.show', [$pirep->dpt_airport_id]) }}" title="{{ $pirep->dpt_airport->name ?? '' }}">{{ $pirep->dpt_airport_id }}</a>
      </td>
      <td class="text-left">
        <a href="{{ route('frontend.airports.show', [$pirep->arr_airport_id]) }}" title="{{ $pirep->arr_airport->name ?? '' }}">{{ $pirep->arr_airport_id }}</a>
      </td>
      <td>
        @if($pirep->aircraft && Dispo_Modules('DisposableAirlines'))
          <a href="{{ route('DisposableAirlines.daircraft', [$pirep->aircraft->registration]) }}">{{ $pirep->aircraft->registration }} ({{ $pirep->aircraft->icao ?? '' }})</a>
        @elseif($pirep->aircraft)
          {{ $pirep->aircraft->registration }} ({{ $pirep->aircraft->icao ?? '' }})
        @endif
      </td>
      <td>@minutestotime($pirep->flight_time)</td>
      <td>{{ $pirep->score }}</td>
      <td>{{ $pirep->landing_rate }} ft/min</td>
      <td>{{ $pirep->submitted_at->diffForHumans() }}</td>
      <td>{!! Dispo_PirepBadge($pirep->state) !!}</td>
      @if($pirep->state === PirepState::PENDING || $pirep->state === PirepState::DRAFT)
        <td>
          <a href="{{ route('frontend.pireps.edit', [$pirep->id]) }}" class="btn btn-sm btn-info">@lang('common.edit')</a>
        </td>
      @endif
    </tr>
  </table>
</div>
