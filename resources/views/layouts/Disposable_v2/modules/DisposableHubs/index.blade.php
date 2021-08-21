@extends('app')
@section('title', trans_choice('DisposableHubs::common.hub',2))

@section('content')
  <div class="row row-cols-3">
    @foreach($hubs->sortBy('name') as $hub)
      <div class="col">
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="p-0 m-1">
              <a href="{{ route('DisposableHubs.hshow', [$hub->id]) }}">{{ $hub->name }}</a>
              <span class="float-right p-0 m-0 flag-icon flag-icon-{{ strtolower($hub->country) }}" style="font-size: 1.5rem;"></span>
            </h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped text-left mb-0">
              <tr>
                <th scope="row">ICAO @lang('DisposableHubs::common.code')</th>
                <td class="text-right">{{ $hub->icao }}</td>
              </tr>
              <tr>
                <th scope="row">IATA @lang('DisposableHubs::common.code')</th>
                <td class="text-right">{{ $hub->iata }}</td>
              </tr>
              <tr>
                <th scope="row">@lang('DisposableHubs::common.location')</th>
                <td class="text-right">{{ $hub->location }}</td>
              </tr>
              <tr>
                <th scope="row">@lang('common.country')</th>
                <td class="text-right">
                  @if(strlen($hub->country) == 2)
                    {{ $country->alpha2($hub->country)['name'] }} ({{ $hub->country }})
                  @else
                    {{ $hub->country }}
                  @endif
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
