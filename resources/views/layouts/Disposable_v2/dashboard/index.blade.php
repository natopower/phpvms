@extends('app')
@section('title', __('common.dashboard'))
@include('disposable_functions')
@section('content')

  @if(Auth::user()->state === \App\Models\Enums\UserState::ON_LEAVE)
    <div class="row">
      <div class="col-sm mb-2">
        <div class="alert alert-warning" role="alert">@lang('disposable.dashonleave')</div>
      </div>
    </div>
  @endif

  {{-- TOP ROW WITH ICON BOXES ONLY --}}
  <div class="row mb-2">
    @include('dashboard.icons')
  </div>

  {{-- MAIN DASHBOARD AREA --}}
  <div class="row">
    {{-- Left --}}
    <div class="col-8">
      {{ Widget::liveMap(['height' => '500px', 'table' => false]) }}
      <div class="card mb-2">
        <div class="card-header p-1"><h5 class="m-1 p-0">@lang('dashboard.yourlastreport')<i class="fas fa-upload float-right"></i></h5></div>
        @if($last_pirep === null)
          <div class="card-body text-center p-1">
            @lang('dashboard.noreportsyet') <a href="{{ route('frontend.pireps.create') }}">@lang('dashboard.fileonenow')</a>
          </div>
        @else
          @include('dashboard.pirep_card', ['pirep' => $last_pirep])
        @endif
      </div>

      {{ Widget::latestNews(['count' => 3]) }}
      @if(Dispo_Modules('DisposableTools'))
        <div class="row">
          <div class="col">
            @widget('Modules\DisposableTools\Widgets\TopPilots', ['type' => 'flights', 'count' => 3, 'period'=> 'lastm'])
          </div>
          <div class="col">
            @widget('Modules\DisposableTools\Widgets\TopPilots', ['type' => 'time', 'count' => 3, 'period'=> 'lastm'])
          </div>
        </div>
      @endif
    </div>

    {{-- Right --}}
    <div class="col">
      <div class="card p-0 mb-2 border-0">
        <a href="{{ route('frontend.flights.bids') }}" class="btn btn-primary">@lang('flights.mybid')</a>
      </div>
      @if(Dispo_Modules('JumpSeat'))
        @widget('Modules\JumpSeat\Widgets\JumpSeat', ['price' => 'auto'])
      @endif
      {{ Widget::Weather(['icao' => $current_airport]) }}
      @if(Dispo_Modules('DisposableTools'))
        @widget('Modules\DisposableTools\Widgets\AirportInfo')
        @if(Theme::getSetting('sb_showbookings'))
          @widget('Modules\DisposableTools\Widgets\ActiveBookings')
        @endif
        @if(Theme::getSetting('whazzup_ivao'))
          @widget('Modules\DisposableTools\Widgets\WhazzUpIVAO')
        @endif
        @if(Theme::getSetting('whazzup_vatsim'))
          @widget('Modules\DisposableTools\Widgets\WhazzUpVATSIM')
        @endif
        @widget('Modules\DisposableTools\Widgets\ActiveUsers')
      @endif
    </div>
  </div>
@endsection
