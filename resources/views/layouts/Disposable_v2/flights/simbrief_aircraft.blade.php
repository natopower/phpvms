@extends('app')
@section('title', 'SimBrief Flight Planning')
@include('disposable_functions')
@section('content')
<div class="row">
  <div class="col-8">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('disposable.selectacflight', ['flight' => $flight->ident])
          <i class="fas fa-plane float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1">
        <select id="aircraftselection" class="form-control select2" onchange="checkacselection()">
          <option value="ZZZZZ">@lang('disposable.selectaircraft')</option>
            @foreach($aircrafts as $ac)
              <option value="{{ $ac->id }}">[{{ $ac->icao }}] {{ $ac->registration }} @if($ac->fuel_onboard > 0)( @lang('disposable.fuelob'): {{ Dispo_Fuel($ac->fuel_onboard) }} )@endif</option>
            @endforeach
        </select>
      </div>
      <div class="card-footer p-1 text-right">
        <a id="generate_link" style="visibility: hidden" href="{{ route('frontend.simbrief.generate') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-primary">@lang('disposable.proceedsb')</a>
      </div>
    </div>
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
    // Simple Aircraft Selection With Dropdown Change
    // Also keep Generate button hidden until a valid AC selection
    const $oldlink = document.getElementById("generate_link").href;

    function checkacselection() {
      if (document.getElementById("aircraftselection").value === "ZZZZZ") {
        document.getElementById('generate_link').style.visibility = 'hidden';
      } else {
        document.getElementById('generate_link').style.visibility = 'visible';
      }
      const selectedac = document.getElementById("aircraftselection").value;
      const newlink = "&aircraft_id=".concat(selectedac);

      document.getElementById("generate_link").href = $oldlink.concat(newlink);
    }
  </script>
@endsection
