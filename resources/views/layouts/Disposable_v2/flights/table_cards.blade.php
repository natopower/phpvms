@foreach($flights as $flight)
  <div class="card mb-2">
    <div class="card-header p-0">
      <table class="table table-sm table-borderless m-0 p-0">
        <tr>
          <td class="align-middle text-left">
            <h5 class="p-0 m-0 ">
              @if(Dispo_Modules('DisposableAirlines')) <a href="{{ route('DisposableAirlines.ashow', [$flight->airline->icao]) }}"> @endif
              @if(optional($flight->airline)->logo)
                <img src="{{ $flight->airline->logo }}" alt="{{$flight->airline->name}}" class="p-0 mr-2 img-mh40"/>
              @else 
                {{ $flight->airline->name ?? '' }}
              @endif
              @if(Dispo_Modules('DisposableAirlines')) </a> @endif
              <a href="{{ route('frontend.flights.show', [$flight->id]) }}" title="@lang('disposable.showflight')">
                {{ $flight->airline->iata ?? $flight->airline->icao }} {{ $flight->flight_number }}
                @if(filled($flight->callsign))
                  [{{ $flight->airline->icao }} {{ $flight->callsign }}]
                @endif
              </a>
            </h5>
          </td>
          <td class="align-middle text-right">
            <button class="btn btn-round btn-icon" title="@lang('disposable.showdetails')" type="button" data-toggle="collapse" data-target="#Details{{$flight->id}}" aria-expanded="false" aria-controls="Details{{$flight->id}}">
              <i class="fas fa-arrows-alt-v p-0 m-0"></i>
            </button>
            <a href="{{ route('frontend.flights.show', [$flight->id]) }}" class="btn btn-round btn-icon" title="@lang('disposable.showflight')">
              <i class="fas fa-info-circle p-0 m-0"></i>
            </a>
            {{--
              !!! IMPORTANT NOTE !!!
              Don't remove the "save_flight" class, or the x-id attribute. It will break the AJAX to save/delete
              "x-saved-class" is the class to add/remove if the bid exists or not. If you change it, remember to change it in the in-array line as well
            --}}
            @if (!setting('pilots.only_flights_from_current') || $flight->dpt_airport_id == $user->current_airport->icao)
              <button class="btn btn-round btn-icon btn-icon-mini save_flight {{ isset($saved[$flight->id]) ? 'btn-info':'' }}"
                      x-id="{{ $flight->id }}"
                      x-saved-class="btn-info"
                      type="button"
                      title="@lang('flights.addremovebid')">
                      <i class="fas fa-map-marker p-0 m-0"></i>
              </button>
            @endif
          </td>
        </tr>
      </table>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm table-borderless table-striped text-center mb-0">
        <tr>
          <th class="text-left" style="width: 50%;">
            <a href="{{ route('frontend.airports.show', [$flight->dpt_airport_id]) }}">{{ $flight->dpt_airport_id }} {{ $flight->dpt_airport->name ?? '' }}</a>
          </th>
          <th class="text-right" style="width: 50%;">
            <a href="{{ route('frontend.airports.show', [$flight->arr_airport_id]) }}">{{ $flight->arr_airport_id }} {{ $flight->arr_airport->name ?? '' }}</a>
          </th>
        </tr>
      </table>
      @if($flight->dpt_time && $flight->arr_time)
        <div class="text-center">
          <span class="float-left pl-1"><b>@lang('disposable.std')</b> {{ $flight->dpt_time }} UTC</span>
          <b>{{ Dispo_FlightDays($flight->days) }}</b>
          <span class="float-right pr-1"><b>@lang('disposable.sta')</b> {{ $flight->arr_time }} UTC</span>
        </div>
      @endif
      <div id="Details{{$flight->id}}" class="collapse">
        <table class="table table-sm table-striped table-borderless mb-0">
            @if($flight->alt_airport_id)
              <tr>
                <th style="width: 15%;">@lang('disposable.alternate')</th>
                <td>
                  <a href="{{route('frontend.airports.show', [$flight->alt_airport_id])}}">
                    {{ $flight->alt_airport_id }} {{ $flight->alt_airport->name ?? '' }}
                  </a>
                </td>
              </tr>
            @endif
            @if(filled($flight->route))
              <tr>
                <th style="width: 15%;">@lang('flights.route')</th>
                <td>{{ strtoupper($flight->route) }}</td>
              </tr>
            @endif
            @if(filled($flight->level))
              <tr>
                <th style="width: 15%;">@lang('flights.level')</th>
                <td>{{ Dispo_Altitude($flight->level) }}</td>
              </tr>
            @endif
            @if($flight->flight_time)
              <tr>
                <th style="width: 15%;">@lang('flights.flighttime')</th>
                <td>@minutestotime($flight->flight_time)</td>
              </tr>
            @endif
            @if(filled($flight->distance))
              <tr>
                <th style="width: 15%;">@lang('common.distance')</th>
                <td>{{ Dispo_Distance($flight->distance) }}</td>
              </tr>
            @endif
            @if($flight->days > 0 || filled($flight->start_date) && filled($flight->end_date))
              <tr>
                <th style="width: 15%;">@lang('disposable.schedule')</th>
                <td>
                  {{ Dispo_FlightDays($flight->days) }}
                  @if(filled($flight->start_date) && filled($flight->end_date))
                    &bull; {{ Carbon::parse($flight->start_date)->format('d.M.Y') }} - {{ Carbon::parse($flight->end_date)->format('d.M.Y') }}
                  @endif
                </td>
              </tr>
            @endif
            @if(filled($flight->notes))
              <tr>
                <th style="width: 15%;">{{ trans_choice('common.note', 2) }}</th>
                <td>{{ $flight->notes }}</td>
              </tr>
            @endif
            @if($flight->subfleets->count())
              <tr>
                <th style="width: 15%;">@lang('disposable.subfleets')</th>
                <td>
                  @php $dispo_airlines = Dispo_Modules('DisposableAirlines'); @endphp
                  @foreach($flight->subfleets as $subfleet)
                    @if(!$loop->first) &bull; @endif
                    @if($dispo_airlines)
                      <a href="{{ route('DisposableAirlines.dsubfleet', [$subfleet->type]) }}">{{ $subfleet->name }} ({{ $subfleet->airline->icao }})</a>
                    @else
                      {{ $subfleet->name }} ({{ $subfleet->airline->icao }})
                    @endif
                  @endforeach
                </td>
              </tr>
            @endif
        </table>
      </div>
    </div>
    <div class="card-footer p-1">
      <div class="row">
        <div class="col text-left">
          <h5 class="mb-0 mt-0">
            @if($flight->flight_type)
              <span class="badge badge-light float-left mr-2">{{ \App\Models\Enums\FlightType::label($flight->flight_type) }}</span>
            @endif
            @if($flight->route_code)
              <span class="badge badge-warning text-black float-left mr-2">{{ Dispo_RouteCode($flight->route_code) }}</span>
            @endif
            @if($flight->route_leg)
              <span class="badge badge-warning text-black float-left mr-2">@lang('disposable.leg') #{{ $flight->route_leg }}</span>
            @endif
          </h5>
        </div>
        <div class="col text-right">
          @if($acars_plugin && isset($saved[$flight->id]))
            <a href="vmsacars:bid/{{ $saved[$flight->id] }}" class="btn btn-sm btn-warning">@lang('disposable.loadacars')</a>
          @elseif($acars_plugin)
            <a href="vmsacars:flight/{{ $flight->id }}" class="btn btn-sm btn-warning">@lang('disposable.loadacars')</a>
          @endif
          @if($simbrief !== false)
            @if($flight->simbrief && $flight->simbrief->user_id == Auth::user()->id)
              <a href="{{ route('frontend.simbrief.briefing', $flight->simbrief->id) }}" class="btn btn-sm btn-secondary">@lang('disposable.sbview')</a>
            @elseif($simbrief_bids === false || ($simbrief_bids === true && isset($saved[$flight->id])))
              <a href="{{ route('frontend.simbrief.generate') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-primary">@lang('disposable.sbgenerate')</a>
            @endif
          @endif
          @if(Theme::getSetting('manual_pireps'))
            <a href="{{ route('frontend.pireps.create') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-info">@lang('disposable.newmanualpirep')</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endforeach
