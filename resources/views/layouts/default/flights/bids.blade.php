@extends('app')
@section('title', __('flights.mybid'))

@section('content')
  <a style="color: #272727" href="/flights"><i style="height: 12px" class="fas fa-arrow-left"></i> flights</a>
  <div class="row">
    @include('flash::message')
    <div class="col-md-12">
      <h2 class="font-weight-bold">{{ __('flights.mybid') }}</h2>
      @include('flights.table')
    </div>
  </div>
@endsection

@include('flights.scripts')

