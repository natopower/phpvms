<div class="col">
  <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
    <div class="card-body bg-transparent p-1">
      <div class="float-right"><i class="fas fa-paper-plane fa-3x text-primary"></i></div>
      <h5 class="card-title m-0 p-0 text-center">{{ $user->flights }}</h5>
      <h6 class="card-title m-0 p-0 text-center">{{ trans_choice('common.flight', $user->flights) }}</h6>
    </div>
  </div>
</div>

<div class="col">
  <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
    <div class="card-body bg-transparent p-1">
      <div class="float-right"><i class="fas fa-clock fa-3x text-primary"></i></div>
      <h5 class="card-title m-0 p-0 text-center">@minutestotime($user->flight_time)</h5>
      <h6 class="card-title m-0 p-0 text-center">@lang('pireps.flighttime')</h6>
    </div>
  </div>
</div>

@if(Dispo_Modules('DisposableTools'))
  <div class="col">
    <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
      <div class="card-body bg-transparent p-1">
        <div class="float-right"><i class="fas fa-plane-arrival fa-3x text-primary"></i></div>
        <h5 class="card-title m-0 p-0 text-center">@widget('Modules\DisposableTools\Widgets\PersonalStats', ['user' => $user->id, 'type' => 'avglanding'])</h5>
        <h6 class="card-title m-0 p-0 text-center">@lang('disposable.avglandingrate')</h6>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
      <div class="card-body bg-transparent p-1">
        <div class="float-right"><i class="fas fa-pen-alt fa-3x text-primary"></i></div>
        <h5 class="card-title m-0 p-0 text-center">@widget('Modules\DisposableTools\Widgets\PersonalStats', ['user' => $user->id, 'type' => 'avgscore'])</h5>
        <h6 class="card-title m-0 p-0 text-center">@lang('disposable.avgscore')</h6>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
      <div class="card-body bg-transparent p-1">
        <div class="float-right"><i class="fas fa-stopwatch fa-3x text-primary"></i></div>
        <h5 class="card-title m-0 p-0 text-center">@widget('Modules\DisposableTools\Widgets\PersonalStats', ['user' => $user->id, 'type' => 'avgtime'])</h5>
        <h6 class="card-title m-0 p-0 text-center">@lang('disposable.avgflighttime')</h6>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
      <div class="card-body bg-transparent p-1">
        <div class="float-right"><i class="fas fa-gas-pump fa-3x text-primary"></i></div>
        <h5 class="card-title m-0 p-0 text-center">@widget('Modules\DisposableTools\Widgets\PersonalStats', ['user' => $user->id, 'type' => 'avgfuel'])</h5>
        <h6 class="card-title m-0 p-0 text-center">@lang('disposable.avgfuelused')</h6>
      </div>
    </div>
  </div>
@endif

<div class="col">
  <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
    <div class="card-body bg-transparent p-1">
      <div class="float-right"><i class="fas fa-map-marker fa-3x text-primary"></i></div>
      <h5 class="card-title m-0 p-0 text-center">{{ optional($user->current_airport)->icao ?? '--' }}</h5>
      <h6 class="card-title m-0 p-0 text-center">@lang('airports.current')</h6>
    </div>
  </div>
</div>

<div class="col">
  <div class="card bg-transparent shadow-none text-dark border-0 mb-2">
    <div class="card-body bg-transparent p-1">
      <div class="float-right"><i class="fas fa-coins fa-3x text-primary"></i></div>
      <h5 class="card-title m-0 p-0 text-center">{{ optional($user->journal)->balance ?? 0 }}</h5>
      <h6 class="card-title m-0 p-0 text-center">@lang('dashboard.yourbalance')</h6>
    </div>
  </div>
</div>
