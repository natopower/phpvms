@extends('app')
@section('title', __('flights.mybid'))
@include('disposable_functions')
@section('content')
  <div class="row">
    <div class="col">
      <h3 class="card-title">@lang('flights.mybid')</h3>
    </div>
  </div>

  <div class="row">
    <div class="col">
      @if (Auth::user()->bids == "[]")
        <div class="alert alert-primary">@lang('flights.none')</div>
      @else
        @include('flights.table_cards')

        @foreach($flights as $biddedflight)
          <hr>
          <h4 class="card-title m-1 p-0">@lang('disposable.wxreportsraw') | {{ $biddedflight->ident }}</h4>
          <div class="row">
            <div class="col">
              <h5 class="card-title m-1 p-0">@lang('disposable.origin')</h5>
              {{ Widget::Weather(['icao' => $biddedflight->dpt_airport_id, 'raw_only' => true]) }}
            </div>
            <div class="col">
              <h5 class="card-title m-1 p-0">@lang('disposable.destination')</h5>
              {{ Widget::Weather(['icao' => $biddedflight->arr_airport_id, 'raw_only' => true]) }}
            </div>
            @if(strlen($biddedflight->alt_airport_id) === 4)
              <div class="col">
                <h5 class="card-title m-1 p-0">@lang('disposable.alternate')</h5>
                {{ Widget::Weather(['icao' => $biddedflight->alt_airport_id, 'raw_only' => true]) }}
              </div>
            @endif
          </div>
        @endforeach
      @endif
    </div>
  </div>
@endsection

@include('flights.scripts')
