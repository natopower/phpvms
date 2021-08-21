@extends('app')
@section('title', trans_choice('common.flight', 2))
@include('disposable_functions')
@section('content')
  <div class="row">
    <div class="col-9">
      @if(Theme::getSetting('flight_cards'))
        @include('flights.table_cards')
      @else
        @include('flights.table_classic')
      @endif
    </div>
    <div class="col-3">
      @include('flights.search')
      @include('flights.nav')
      @if(Theme::getSetting('flight_dispomap') && Dispo_Modules('DisposableTools'))
        @widget('Modules\DisposableTools\Widgets\FlightsMap')
      @endif
    </div>
  </div>

  <div class="row">
    <div class="col-9 text-center mt-3">
      {{ $flights->links('pagination.default') }}
    </div>
  </div>
@endsection
@include('flights.scripts')
