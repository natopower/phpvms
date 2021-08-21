@extends('app')
@section('title', __('DisposableAirlines::common.airlines'))

@section('content')
  <div class="row row-cols-3">
    @foreach($airlines->sortBy('name') as $airline)
      <div class="col">
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="p-0 m-1">
              <a href="{{ route('DisposableAirlines.ashow', [$airline->icao]) }}">{{ $airline->name }}</a>
              <span class="float-right p-0 m-0 flag-icon flag-icon-{{ strtolower($airline->country) }}" style="font-size: 1.5rem;"></span>
            </h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped text-left mb-0">
              <tr>
                <th scope="row">ICAO @lang('DisposableAirlines::common.code')</th>
                <td class="text-right">{{ $airline->icao }}</td>
              </tr>
              <tr>
                <th scope="row">IATA @lang('DisposableAirlines::common.code')</th>
                <td class="text-right">{{ $airline->iata ?? '--' }}</td>
              </tr>
              <tr>
                <th scope="row">@lang('common.country')</th>
                <td class="text-right">{{ $country->alpha2($airline->country)['name'] }} ({{ strtoupper($airline->country) }})</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
