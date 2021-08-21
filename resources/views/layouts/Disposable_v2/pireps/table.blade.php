<table class="table table-sm table-striped table-borderless mb-0 text-left">
  <tr>
    <th>{{ trans_choice('common.flight', 1) }}</th>
    <th>@lang('common.departure')</th>
    <th>@lang('common.arrival')</th>
    <th>@lang('common.aircraft')</th>
    <th class="text-center">@lang('flights.flighttime')</th>
    <th class="text-center">@lang('disposable.score')</th>
    <th class="text-center">@lang('disposable.landingrate')</th>
    <th class="text-center">@lang('pireps.submitted')</th>
    <th class="text-center">@lang('common.status')</th>
    <th class="text-center"></th>
  </tr>
  @foreach($pireps as $pirep)
    <tr>
      <td><a href="{{ route('frontend.pireps.show', [$pirep->id]) }}">{{ $pirep->airline->code }} {{ $pirep->ident }}</a></td>
      <td><a href="{{route('frontend.airports.show', [$pirep->dpt_airport_id])}}">{{ $pirep->dpt_airport_id }} {{ $pirep->dpt_airport->name ?? '' }}</a></td>
      <td><a href="{{route('frontend.airports.show', [$pirep->arr_airport_id])}}">{{ $pirep->arr_airport_id }} {{ $pirep->arr_airport->name ?? '' }}</a></td>
      <td>
        @if($pirep->aircraft && Dispo_Modules('DisposableAirlines'))
          <a href="{{ route('DisposableAirlines.daircraft', [$pirep->aircraft->registration]) }}">{{ $pirep->aircraft->registration }} ({{ $pirep->aircraft->icao }})</a>
        @elseif($pirep->aircraft)
          {{ $pirep->aircraft->registration ?? '' }} ({{ $pirep->aircraft->icao ?? ''}})
        @endif
      </td>
      <td class="text-center">@minutestotime($pirep->flight_time)</td>
      <td class="text-center">@if(filled($pirep->score)) {{ $pirep->score }} @endif</td>
      <td class="text-center">@if(filled($pirep->landing_rate)) {{ number_format($pirep->landing_rate,2) }} ft/min @endif</td>
      <td class="text-center">@if(filled($pirep->submitted_at)) {{ $pirep->submitted_at->diffForHumans() }} @endif</td>
      <td class="text-center">{!! Dispo_PirepBadge($pirep->state) !!}</td>
      <td class="text-center">
        @if(!$pirep->read_only)
          <a href="{{ route('frontend.pireps.edit', [$pirep->id]) }}" class="btn btn-info btn-sm" title="@lang('common.edit')">@lang('common.edit')</a>
        @endif
      </td>
    </tr>
  @endforeach
</table>
