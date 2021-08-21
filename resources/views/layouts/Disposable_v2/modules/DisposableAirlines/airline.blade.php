@extends('app')
@section('title', $airline->name)

@section('content')
  <div class="row">
    {{-- LEFT --}}
    <div class="col-9">
      <ul class="nav nav-pills nav-fill mb-2" id="pills-tab" role="tablist">
        <li class="nav-item pr-1 pl-1" role="presentation">
          <a class="nav-link dispo-pills active" id="pills-fleet-tab" data-toggle="pill" href="#pills-fleet" role="tab" aria-controls="pills-fleet" aria-selected="true">@lang('DisposableAirlines::common.fleet')</a>
        </li>
        <li class="nav-item pr-1 pl-1" role="presentation">
          <a class="nav-link dispo-pills" id="pills-pilots-tab" data-toggle="pill" href="#pills-pilots" role="tab" aria-controls="pills-pilots" aria-selected="false">@lang('DisposableAirlines::common.pilots')</a>
        </li>
        <li class="nav-item pr-1 pl-1" role="presentation">
          <a class="nav-link dispo-pills" id="pills-pireps-tab" data-toggle="pill" href="#pills-pireps" role="tab" aria-controls="pills-pireps" aria-selected="false">@lang('DisposableAirlines::common.pireps')</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-fleet" role="tabpanel" aria-labelledby="pills-fleet-tab">
          @include('DisposableAirlines::airline_fleet')
        </div>
        <div class="tab-pane fade" id="pills-pilots" role="tabpanel" aria-labelledby="pills-pilots-tab">
          @include('DisposableAirlines::airline_pilots')
        </div>
        <div class="tab-pane fade" id="pills-pireps" role="tabpanel" aria-labelledby="pills-pireps-tab">
          @include('DisposableAirlines::airline_pireps')
        </div>
      </div>
    </div>
    {{-- RIGHT --}}
    <div class="col-3">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            @lang('DisposableAirlines::common.adetails')
            <i class="fas fa-info float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-borderless table-striped text-left mb-0">
            <tr>
              <th style="width:30%;">@lang('common.name')</th>
              <td>{{ $airline->name }}</td>
            </tr>
            <tr>
              <th>ICAO @lang('DisposableAirlines::common.code')</th>
              <td>{{ $airline->icao }}</td>
            </tr>
            <tr>
              <th>IATA @lang('DisposableAirlines::common.code')</th>
              <td>{{ $airline->iata }}</td>
            </tr>
            <tr>
              <th>@lang('common.country')</th>
              <td>{{ $country->alpha2($airline->country)['name'] }} ({{ strtoupper($airline->country) }})</td>
            </tr>
          </table>
        </div>
        @if(filled($airline->logo))
          <div class="card-footer p-1 text-center">
            <img src="{{ $airline->logo }}" style="max-width: 90%; max-height: 70px;">
          </div>
        @endif
      </div>
      @if($disptools)
        @widget('Modules\DisposableTools\Widgets\FlightsMap', ['source' => $airline->id])
      @endif
      @if($disptools && $pireps->count() > 0)
        @widget('Modules\DisposableTools\Widgets\AirlineStats', ['airline' => $airline->id])
      @endif
      <div class="card">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            @lang('DisposableAirlines::common.afinance')
            <i class="fas fa-receipt float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-borderless table-striped text-left mb-0">
          <tr>
            <th>@lang('DisposableAirlines::common.aincome')</th>
            <td class="text-right">
              {{ money($income, setting('units.currency')) }}
            </td>
          </tr>
          <tr>
            <th>@lang('DisposableAirlines::common.aexpense')</th>
            <td class="text-right">
              {{ money($expense, setting('units.currency')) }}
            </td>
          </tr>
          <tr>
            <th>@lang('DisposableAirlines::common.abalance')</th>
            <td class="text-right">
              <span style="color: @if($balance > 0) darkgreen @else darkred @endif;">
                <b>{{ money($balance, setting('units.currency')) }}</b>
              </span>
            </td>
          </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  {{-- Custom Style For Inactive Tabs --}}
  <style>
    .dispo-pills { color: black; background-color: lightslategray;}
  </style>
@endsection
