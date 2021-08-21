<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      {{ trans_choice('common.flight',2) }}
      <i class="fas fa-paper-plane float-right"></i>
    </h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-sm table-striped table-borderless text-center mb-0">
      <tr>
        <th class="text-left">@lang('common.airline')</th>
        <th class="text-left">@lang('flights.flightnumber')</th>
        <th class="text-left">@lang('flights.callsign')</th>
        <th>@lang('disposable.origin')</th>
        <th>@lang('disposable.std')</th>
        <th>@lang('disposable.sta')</th>
        <th>@lang('disposable.destination')</th>
        <th>@lang('disposable.code')</th>
        <th>@lang('disposable.leg')</th>
        <th>@lang('disposable.subfleets')</th>
        <th class="text-right">@lang('disposable.actions')</th>
      </tr>
      @foreach($flights as $flight)
        <tr>
          <td class="align-middle text-left">
            @if(Dispo_Modules('DisposableAirlines')) <a href="{{ route('DisposableAirlines.ashow', [$flight->airline->icao]) }}"> @endif
            @if(optional($flight->airline)->logo)
              <img src="{{ $flight->airline->logo }}" alt="{{$flight->airline->name}}" class="img-mh30"/>
            @else
              {{ $flight->airline->name ?? '' }}
            @endif
            @if(Dispo_Modules('DisposableAirlines')) </a> @endif
          </td>
          <td class="align-middle text-left">{{ $flight->airline->iata ?? $flight->airline->icao }} {{ $flight->flight_number }}</td>
          <td class="align-middle text-left">{{ $flight->airline->icao }} {{ $flight->callsign ?? $flight->flight_number }}</td>
          <td class="align-middle">
            <a href="{{ route('frontend.airports.show', [$flight->dpt_airport_id]) }}"><span title="{{ $flight->dpt_airport->name ?? '' }}">{{ $flight->dpt_airport_id }}</span></a>
          </td>
          <td class="align-middle">{{ $flight->dpt_time }}</td>
          <td class="align-middle">{{ $flight->arr_time }}</td>
          <td class="align-middle">
            <a href="{{ route('frontend.airports.show', [$flight->arr_airport_id]) }}"><span title="{{ $flight->arr_airport->name ?? '' }}">{{ $flight->arr_airport_id }}</span></a>
          </td>
          <td class="align-middle">{{ Dispo_RouteCode($flight->route_code) }}</td>
          <td class="align-middle">{{ $flight->route_leg }}</td>
          <td class="align-middle">@if($flight->subfleets->count()) {{ $flight->subfleets->count() }} @endif</td>
          <td class="align-middle text-right">
            <a href="{{ route('frontend.flights.show', [$flight->id]) }}" class="btn btn-sm btn-info" title="@lang('disposable.showflight')">
              <i class="fas fa-info-circle p-0 m-0"></i>
            </a>
            @if($acars_plugin && isset($saved[$flight->id]))
            <a href="vmsacars:bid/{{ $saved[$flight->id] }}" class="btn btn-sm btn-warning" title="@lang('disposable.loadacars')">
              <i class="fas fa-download p-0 m-0"></i>
            </a>
            @elseif($acars_plugin)
              <a href="vmsacars:flight/{{ $flight->id }}" class="btn btn-sm btn-warning" title="@lang('disposable.loadacars')">
                <i class="fas fa-download p-0 m-0"></i>
              </a>
            @endif
            @if($simbrief !== false)
              @if($flight->simbrief && $flight->simbrief->user_id == Auth::user()->id)
                <a href="{{ route('frontend.simbrief.briefing', $flight->simbrief->id) }}" class="btn btn-sm btn-success" title="@lang('disposable.sbview')">
              @elseif($simbrief_bids === false || ($simbrief_bids === true && isset($saved[$flight->id])))
                <a href="{{ route('frontend.simbrief.generate') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-secondary" title="@lang('disposable.sbgenerate')">
              @endif
                  <i class="fas fa-file-pdf p-0 m-0"></i>
                </a>
            @endif
            @if(Theme::getSetting('manual_pireps'))
              <a href="{{ route('frontend.pireps.create') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-danger" title="@lang('disposable.newmanualpirep')">
                <i class="fas fa-file-upload p-0 m-0"></i>
              </a>
            @endif
            {{--
              !!! IMPORTANT NOTE !!!
              Don't remove the "save_flight" class, or the x-id attribute. It will break the AJAX to save/delete
              "x-saved-class" is the class to add/remove if the bid exists or not. If you change it, remember to change it in the in-array line as well
            --}}
            @if (!setting('pilots.only_flights_from_current') || $flight->dpt_airport_id == Auth::user()->current_airport->icao)
              <button class="btn btn-sm save_flight {{ isset($saved[$flight->id]) ? 'btn-success':'btn-primary' }}"
                      x-id="{{ $flight->id }}"
                      x-saved-class="btn-success"
                      type="button"
                      title="@lang('flights.addremovebid')">
                      <i class="fas fa-map-marker p-0 m-0"></i>
              </button>
            @endif
          </td>
        </tr>
      @endforeach
    </table>
  </div>
  <div class="card-footer text-right p-1">
    <h5 class="m-1 p-0">@lang('disposable.total'): {{ $flights->total() }}</h5>
  </div>
</div>
