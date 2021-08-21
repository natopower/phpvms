@extends('app')
@section('title', $flight->ident)
@include('disposable_functions')
@section('content')
  <div class="row">
    <div class="col-8">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            {{ $flight->airline->iata ?? $flight->airline->icao }} {{ $flight->flight_number }}
            @if(filled($flight->callsign)) <span class="float-right">{{$flight->airline->icao}} {{$flight->callsign}}</span> @endif
          </h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-striped table-borderless mb-0">
            <tr>
              <th style="width: 15%;">@lang('disposable.origin')</th>
              <td>
                <a href="{{ route('frontend.airports.show', [$flight->dpt_airport_id]) }}">
                  {{ $flight->dpt_airport_id }} : {{ $flight->dpt_airport->name ?? '' }}
                </a>
                  @if($flight->dpt_time) <span class="float-right"><b>@lang('disposable.std')</b> {{ $flight->dpt_time }} UTC</span>@endif
              </td>
            </tr>
            <tr>
              <th>@lang('disposable.destination')</th>
              <td>
                <a href="{{ route('frontend.airports.show', [$flight->arr_airport_id]) }}">
                  {{ $flight->arr_airport_id }} : {{ $flight->arr_airport->name ?? '' }}
                </a>
                  @if($flight->arr_time) <span class="float-right"><b>@lang('disposable.sta')</b> {{ $flight->arr_time }} UTC</span>@endif
              </td>
            </tr>
            @if($flight->alt_airport_id)
              <tr>
                <th>@lang('disposable.alternate')</th>
                <td>
                  <a href="{{ route('frontend.airports.show', [$flight->alt_airport_id]) }}">
                    {{ $flight->alt_airport_id }} : {{ $flight->alt_airport->name ?? '' }}
                  </a>
                </td>
              </tr>
            @endif
            @if(filled($flight->route))
              <tr>
                <th>@lang('flights.route')</th>
                <td>{{ strtoupper($flight->route) }}</td>
              </tr>
            @endif
            @if(filled($flight->level))
              <tr>
                <th>@lang('flights.level')</th>
                <td>{{ Dispo_Altitude($flight->level) }}</td>
              </tr>
            @endif
            @if($flight->flight_time)
              <tr>
                <th>@lang('flights.flighttime')</th>
                <td>@minutestotime($flight->flight_time)</td>
              </tr>
            @endif
            @if(filled($flight->distance))
              <tr>
                <th>@lang('common.distance')</th>
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
                <th>{{ trans_choice('common.note', 2) }}</th>
                <td>{{ $flight->notes }}</td>
              </tr>
            @endif
            @if($flight->subfleets->count())
              <tr>
                <th>@lang('disposable.subfleets')</th>
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
        <div class="card-footer p-1">
          @if($flight->flight_type)
            <h5 class="mb-0 mt-0"><span class="badge badge-light float-left mr-2 ml-2">{{ \App\Models\Enums\FlightType::label($flight->flight_type) }}</span></h5>
          @endif
          @if($flight->route_leg)
            <h5 class="mb-0 mt-0"><span class="badge badge-warning text-black float-right mr-2 ml-1">@lang('disposable.leg') #{{ $flight->route_leg }}</span></h5>
          @endif
          @if($flight->route_code)
            <h5 class="mb-0 mt-0">
              <span class="badge badge-warning text-black float-right mr-1 ml-2">{{ Dispo_RouteCode($flight->route_code) }}</span>
            </h5>
          @endif
        </div>
      </div>

      @include('flights.map')

    </div>
    <div class="col">
      {{-- Nav Buttons --}}
      <ul class="nav nav-pills nav-justified mb-2" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link dispo-pills mr-2 ml-2 active" id="pills-orig-tab" data-toggle="pill" href="#pills-orig" role="tab" aria-controls="pills-orig" aria-selected="true">@lang('disposable.origin')</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link dispo-pills mr-2 ml-2" id="pills-dest-tab" data-toggle="pill" href="#pills-dest" role="tab" aria-controls="pills-dest" aria-selected="false">@lang('disposable.destination')</a>
        </li>
        @if($flight->alt_airport_id)
          <li class="nav-item" role="presentation">
            <a class="nav-link dispo-pills mr-2 ml-2" id="pills-altn-tab" data-toggle="pill" href="#pills-altn" role="tab" aria-controls="pills-altn" aria-selected="false">@lang('disposable.alternate')</a>
          </li>
        @endif
      </ul>
      {{-- Button Controlled Content --}}
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-orig" role="tabpanel" aria-labelledby="pills-orig-tab">
          {{ Widget::Weather(['icao' => $flight->dpt_airport_id]) }}
          @if(Dispo_Modules('DisposableTools'))
            @widget('Modules\DisposableTools\Widgets\SunriseSunset', ['location' => $flight->dpt_airport_id])
          @endif
        </div>
        <div class="tab-pane fade" id="pills-dest" role="tabpanel" aria-labelledby="pills-dest-tab">
          @if($flight->flight_time > 60)
            {{ Widget::Weather(['icao' => $flight->arr_airport_id, 'raw_only' => true]) }}
          @else
            {{ Widget::Weather(['icao' => $flight->arr_airport_id]) }}
          @endif
          @if(Dispo_Modules('DisposableTools'))
            @widget('Modules\DisposableTools\Widgets\SunriseSunset', ['location' => $flight->arr_airport_id])
          @endif
        </div>
        <div class="tab-pane fade" id="pills-altn" role="tabpanel" aria-labelledby="pills-altn-tab">
          @if($flight->alt_airport_id)
            {{ Widget::Weather(['icao' => $flight->alt_airport_id, 'raw_only' => true]) }}
            @if(Dispo_Modules('DisposableTools'))
              @widget('Modules\DisposableTools\Widgets\SunriseSunset', ['location' => $flight->alt_airport_id])
            @endif
          @endif
        </div>
      </div>
      {{-- Generic Buttons --}}
      @if(Theme::getSetting('flight_bid'))
        @if(!setting('pilots.only_flights_from_current') || $flight->dpt_airport_id === Auth::user()->current_airport->icao)
          {{-- !!! IMPORTANT NOTE !!! Don't remove the "save_flight" class, It will break the AJAX to save/delete --}}
          <span class="btn btn-sm save_flight {{isset($bid) ? 'btn-danger':'btn-success'}} float-right ml-1" onclick="AddRemoveBid('{{isset($bid) ? 'remove':'add'}}')">
            @lang('flights.addremovebid')
          </span>
        @endif
      @endif
      @if(Theme::getSetting('flight_simbrief') && filled(setting('simbrief.api_key')))
        @if(!setting('simbrief.only_bids') || setting('simbrief.only_bids') && isset($bid))
          @if($flight->simbrief && $flight->simbrief->user_id == Auth::user()->id)
            <a id="mylink" href="{{ route('frontend.simbrief.briefing', $flight->simbrief->id) }}" class="btn btn-sm btn-secondary float-right ml-1">@lang('disposable.sbview')</a>
          @else
            <a id="mylink" href="{{ route('frontend.simbrief.generate') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-primary float-right ml-1">@lang('disposable.sbgenerate')</a>
          @endif
        @endif
      @endif
      @if(Theme::getSetting('manual_pireps'))
        <a href="{{ route('frontend.pireps.create') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-info float-right ml-1">@lang('disposable.newmanualpirep')</a>
      @endif
      @if($acars_plugin && isset($bid))
        <a href="vmsacars:bid/{{ $bid->id }}" class="btn btn-sm btn-warning float-right ml-1">@lang('disposable.loadacars')</a>
      @elseif($acars_plugin)
        <a href="vmsacars:flight/{{ $flight->id }}" class="btn btn-sm btn-warning float-right ml-1">@lang('disposable.loadacars')</a>
      @endif
    </div>
  </div>

  @if(Theme::getSetting('flight_bid'))
    {{-- DO NOT REMOVE THIS SCRIPT IT IS USED FOR BIDDING FROM FLIGHT DETAILS PAGE --}}
    <script type="text/javascript">
      async function AddRemoveBid(action) {

        const flight_id = "{{$flight->id}}";

        if (action === "add") {
          await phpvms.bids.addBid(flight_id);
          console.log('successfully saved flight');
          alert('@lang("flights.bidadded")');
          location.reload();
        } else {
          await phpvms.bids.removeBid(flight_id);
          console.log('successfully removed flight');
          alert('@lang("flights.bidremoved")');
          location.reload();
        }
      }
    </script>
  @endif
@endsection
