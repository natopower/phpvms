<div class="row">
  <div class="col">
    <div class="card mb-2">
      <div class="card-header p-1"><h5 class="m-1 p-0">@lang('flights.search')</h5></div>
      {{ Form::open(['route' => 'frontend.flights.search','method' => 'GET',]) }}
      <div class="card-body p-1">
        <div class="form-group input-group-sm">
          <label for="airline_id" class="control-label">@lang('common.airline')</label>
          @php asort($airlines); @endphp
          {{ Form::select('airline_id', $airlines, null , ['class' => 'form-control select2']) }}
        </div>

        <div class="form-group input-group-sm">
          <label for="flight_type" class="control-label">@lang('flights.flighttype')</label>
          {{ Form::select('flight_type', $flight_types, null , ['class' => 'form-control select2']) }}
        </div>

        <div class="form-group input-group-sm">
          <label for="flight_number">@lang('flights.flightnumber')</label>
          {{ Form::text('flight_number', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group input-group-sm">
          <label for="route_code">@lang('disposable.code')</label>
          {{ Form::text('route_code', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group input-group-sm">
         <label for="dep_icao" class="control-label">@lang('airports.departure')</label>
         {{ Form::select('dep_icao', $airports, null , ['class' => 'form-control select2']) }}
        </div>

        <div class="form-group input-group-sm">
          <label for="arr_icao" class="control-label">@lang('airports.arrival')</label>
          {{ Form::select('arr_icao', $airports, null , ['class' => 'form-control select2']) }}
        </div>

        <div class="form-group input-group-sm">
          <label for="subfleet_id" class="control-label">@lang('common.subfleet')</label>
          @php asort($subfleets); @endphp
          {{ Form::select('subfleet_id', $subfleets, null , ['class' => 'form-control select2']) }}
        </div>
      </div>
      <div class="card-footer p-1">
        <div class="row">
          <div class="col text-center"><a href="{{ route('frontend.flights.index') }}" class="btn btn-sm btn-info">@lang('common.reset')</a></div>
          <div class="col text-center">{{ Form::submit(__('common.find'), ['class' => 'btn btn-sm btn-primary']) }}</div>
        </div>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
