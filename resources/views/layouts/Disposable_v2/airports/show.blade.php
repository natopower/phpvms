@extends('app')
@section('title', $airport->full_name)
@include('disposable_functions')
@section('content')
  <div class="row">
    <div class="col-4">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="p-0 m-1">
            @lang('disposable.apdetails')
            <i class="fas fa-info float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-borderless table-striped mb-0">
            <tr>
              <th scope="row">ICAO / IATA @lang('disposable.code')</th>
              <td>{{ $airport->icao }} / {{ $airport->iata }}</td>
            </tr>
            <tr>
              <th scope="row">@lang('common.name')</th>
              <td>{{ $airport->name }}</td>
            </tr>
            <tr>
              <th scope="row">@lang('disposable.location')</th>
              <td>{{ $airport->location }}</td>
            </tr>
            <tr>
              <th scope="row">@lang('common.country')</th>
              <td>
                {{ $airport->country }}
              </td>
            </tr>
            @if(filled($airport->timezone))
              <tr>
                <th scope="row">@lang('common.timezone')</th>
                <td>{{ $airport->timezone }}</td>
              </tr>
            @endif
            @if($airport->ground_handling_cost > 0)
              <tr>
                <th scope="row">@lang('disposable.groundhandling') @lang('disposable.cost')</th>
                <td>{{ $airport->ground_handling_cost }} {{ setting('units.currency') }}/{{ trans_choice('common.flight',1) }}</td>
              </tr>
            @endif
            @if($airport->fuel_100ll_cost > 0)
              <tr>
                <th scope="row">100LL @lang('disposable.cost')</th>
                <td>{{ Dispo_FuelCost($airport->fuel_100ll_cost) }}</td>
              </tr>
            @endif
            @if($airport->fuel_mogas_cost > 0)
              <tr>
                <th scope="row">MOGAS @lang('disposable.cost')</th>
                <td>{{ Dispo_FuelCost($airport->fuel_mogas_cost) }}</td>
              </tr>
            @endif
            @if($airport->fuel_jeta_cost > 0)
              <tr>
                <th scope="row">JET-A1 @lang('disposable.cost')</th>
                <td>{{ Dispo_FuelCost($airport->fuel_jeta_cost) }}</td>
              </tr>
            @endif
          </table>
        </div>
      </div>
      {{ Widget::Weather(['icao' => $airport->icao]) }}

      {{-- Show if there are files uploaded and a user is logged in--}}
      @if(count($airport->files) > 0 && Auth::check())
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="m-1 p-0">
              {{ trans_choice('common.download', 2) }}
              <i class="fas fa-download float-right"></i>
            </h5>
          </div>
          <div class="card-body p-0">
            @include('downloads.table', ['files' => $airport->files])
          </div>
        </div>
      @endif
    </div>
    <div class="col-8">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            {{ $airport->full_name }}
            <i class="fas fa-map float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          {{ Widget::AirspaceMap(['width' => '100%', 'height' => '500px', 'lat' => $airport->lat, 'lon' => $airport->lon]) }}
        </div>
      </div>
    </div>
  </div>

  <div class="row row-cols-2">
    <div class="col">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            @lang('flights.inbound')
            <i class="fas fa-paper-plane float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0 overflow-auto">
          @if(!$inbound_flights)
            <div class="jumbotron text-center mb-0">@lang('flights.none')</div>
          @else
            <table class="table table-sm table-striped table-borderless text-center mb-0">
              <thead>
                <tr>
                  <th class="text-left">@lang('airports.ident')</th>
                  <th class="text-left">@lang('airports.departure')</th>
                  <th>@lang('flights.dep')</th>
                  <th>@lang('flights.arr')</th>
                </tr>
              </thead>
              <tbody>
              @foreach($inbound_flights as $flight)
                <tr>
                  <td class="text-left"><a href="{{ route('frontend.flights.show', [$flight->id]) }}">{{ $flight->ident }}</a></td>
                  <td class="text-left">
                    <a href="{{ route('frontend.airports.show',[$flight->dpt_airport_id]) }}">
                      {{ $flight->dpt_airport_id }} {{ $flight->dpt_airport->name ?? '' }}
                    </a>
                  </td>
                  <td>{{ $flight->dpt_time }}</td>
                  <td>{{ $flight->arr_time }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            @lang('flights.outbound')
            <i class="fas fa-paper-plane float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0 overflow-auto">
          @if(!$outbound_flights)
            <div class="jumbotron text-center mb-0">@lang('flights.none')</div>
          @else
            <table class="table table-sm table-striped table-borderless text-center mb-0">
              <thead>
                <tr>
                  <th class="text-left">@lang('airports.ident')</th>
                  <th class="text-left">@lang('airports.arrival')</th>
                  <th>@lang('flights.dep')</th>
                  <th>@lang('flights.arr')</th>
                </tr>
              </thead>
              <tbody>
              @foreach($outbound_flights as $flight)
                <tr>
                  <td class="text-left"><a href="{{ route('frontend.flights.show', [$flight->id]) }}">{{ $flight->ident }}</a></td>
                  <td class="text-left">
                    <a href="{{route('frontend.airports.show',['id'=>$flight->arr_airport_id])}}">
                      {{ $flight->arr_airport_id }} {{ $flight->arr_airport->name ?? ''}}
                    </a>
                  </td>
                  <td>{{ $flight->dpt_time }}</td>
                  <td>{{ $flight->arr_time }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>

  @if(Dispo_Modules('DisposableTools'))
    <div class="row row-cols-2">
      <div class="col">
        @widget('Modules\DisposableTools\Widgets\AirportAircrafts', ['location' => $airport->id])
      </div>
      <div class="col">
        @widget('Modules\DisposableTools\Widgets\AirportPireps', ['location' => $airport->id])
      </div>
    </div>
  @endif
@endsection
