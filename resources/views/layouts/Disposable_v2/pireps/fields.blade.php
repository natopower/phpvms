{{--

NOTE ABOUT THIS VIEW

The fields that are marked "read-only", make sure the read-only status doesn't change!
If you make those fields editable, after they're in a read-only state, it can have
an impact on your stats and financials, and will require a recalculation of all the
flight reports that have been filed. You've been warned!

--}}
@if(!empty($pirep) && $pirep->read_only)
  <div class="row">
    <div class="col">
        <h5 class="p-0 mb-1">
          <span class="badge badge-warning"><i class="fas fa-info mr-1"></i>@lang('pireps.fieldsreadonly')</span>
        </h5>
    </div>
  </div>
@endif
<div class="row">
  <div class="col-8">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('pireps.flightinformations')
          <i class="fas fa-info-circle float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1">
        <div class="row row-cols-3">
          <div class="col">
            {{ Form::label('airline_id', __('common.airline')) }}
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ $pirep->airline->name }}</p>
              {{ Form::hidden('airline_id') }}
            @else
              @php asort($airline_list); @endphp
              {{ Form::select('airline_id', $airline_list, null, [
                  'class' => 'custom-select select2',
                  'style' => 'width: 100%',
                  'readonly' => (!empty($pirep) && $pirep->read_only),
              ]) }}
            @endif
          </div>
          <div class="col">
            {{ Form::label('flight_number', __('pireps.flightident')) }}
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ $pirep->ident }}
                {{ Form::hidden('flight_number') }}
                {{ Form::hidden('flight_code') }}
                {{ Form::hidden('flight_leg') }}
              </p>
            @else
              <div class="input-group input-group-sm mb-3">
                {{ Form::text('flight_number', null, [
                    'placeholder' => __('flights.flightnumber'),
                    'class' => 'form-control',
                    'readonly' => (!empty($pirep) && $pirep->read_only),
                ]) }}
                &nbsp;
                {{ Form::text('route_code', null, [
                    'placeholder' => __('pireps.codeoptional'),
                    'class' => 'form-control',
                    'readonly' => (!empty($pirep) && $pirep->read_only),
                ]) }}
                &nbsp;
                {{ Form::text('route_leg', null, [
                    'placeholder' => __('pireps.legoptional'),
                    'class' => 'form-control',
                    'readonly' => (!empty($pirep) && $pirep->read_only),
                ]) }}
              </div>
            @endif
          </div>
          <div class="col">
            {{ Form::label('flight_type', __('flights.flighttype')) }}
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ \App\Models\Enums\FlightType::label($pirep->flight_type) }}</p>
              {{ Form::hidden('flight_type') }}
            @else
              {{ Form::select('flight_type',
                  \App\Models\Enums\FlightType::select(), null, [
                      'class' => 'custom-select select2',
                      'style' => 'width: 100%',
                      'readonly' => (!empty($pirep) && $pirep->read_only),
                  ])
              }}
            @endif
          </div>
        </div>
        <div class="row row-cols-3">
          <div class="col">
            {{ Form::label('hours', __('flights.flighttime')) }}
            @if(!empty($pirep) && $pirep->read_only)
              <p>
                {{ $pirep->hours.' '.trans_choice('common.hour', $pirep->hours) }}
                , {{ $pirep->minutes.' '.trans_choice('common.minute', $pirep->minutes) }}
                {{ Form::hidden('hours') }}
                {{ Form::hidden('minutes') }}
              </p>
            @else
              <div class="input-group input-group-sm">
                {{ Form::number('hours', null, [
                        'class' => 'form-control',
                        'placeholder' => trans_choice('common.hour', 2),
                        'min' => '0',
                        'readonly' => (!empty($pirep) && $pirep->read_only),
                ]) }}
                {{ Form::number('minutes', null, [
                        'class' => 'form-control',
                        'placeholder' => trans_choice('common.minute', 2),
                        'min' => 0,
                        'readonly' => (!empty($pirep) && $pirep->read_only),
                ]) }}
              </div>
            @endif
          </div>
          <div class="col">
            {{ Form::label('distance', __('common.distance')) }} ({{config('phpvms.internal_units.distance')}})
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ $pirep->distance }}</p>
            @else
              {{ Form::number('distance', null, [
                  'class' => 'form-control form-control-sm',
                  'min' => '0',
                  'step' => '1',
                  'readonly' => (!empty($pirep) && $pirep->read_only),
                  ]) }}
            @endif
          </div>
          <div class="col">
            {{ Form::label('level', __('flights.level')) }} ({{config('phpvms.internal_units.altitude')}})
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ $pirep->level }}</p>
            @else
              {{ Form::number('level', null, [
                  'class' => 'form-control form-control-sm',
                  'min' => '0',
                  'step' => '500',
                  'readonly' => (!empty($pirep) && $pirep->read_only),
                  ]) }}
            @endif
          </div>
        </div>
      </div>
      @if($errors->first('airline_id') || $errors->first('flight_number') || $errors->first('flight_type')
          || $errors->first('route_code') || $errors->first('route_leg') || $errors->first('level')
          || $errors->first('hours') || $errors->first('minutes'))
        <div class="card-footer p-1 text-left">
          <p class="text-danger p-0 m-0">{{ $errors->first('airline_id') }}</p>
          <p class="text-danger p-0 m-0">{{ $errors->first('flight_number') }}</p>
          <p class="text-danger p-0 m-0">{{ $errors->first('route_code') }}</p>
          <p class="text-danger p-0 m-0">{{ $errors->first('route_leg') }}</p>
          <p class="text-danger p-0 m-0">{{ $errors->first('flight_type') }}</p>
          <p class="text-danger p-0 m-0">{{ $errors->first('hours') }}</p>
          <p class="text-danger p-0 m-0">{{ $errors->first('minutes') }}</p>
          <p class="text-danger p-0 m-0">{{ $errors->first('level') }}</p>
        </div>
      @endif
    </div>

    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('pireps.deparrinformations')
          <i class="fas fa-globe float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1">
        <div class="row row-cols-2">
          <div class="col">
            {{ Form::label('dpt_airport_id', __('airports.departure')) }}
            @if(!empty($pirep) && $pirep->read_only)
              <a href="{{route('frontend.airports.show', ['id' => $pirep->dpt_airport->icao])}}">
              {{ $pirep->dpt_airport->name }} / {{$pirep->dpt_airport->icao}}</a>
              {{ Form::hidden('dpt_airport_id') }}
            @else
              {{ Form::select('dpt_airport_id', $airport_list, null, [
                      'class' => 'custom-select select2',
                      'style' => 'width: 100%',
                      'readonly' => (!empty($pirep) && $pirep->read_only),
                ]) }}
            @endif
          </div>
          <div class="col">
            {{ Form::label('arr_airport_id', __('airports.arrival')) }}
            @if(!empty($pirep) && $pirep->read_only)
              <a href="{{route('frontend.airports.show', ['id' => $pirep->arr_airport->icao])}}">
              {{ $pirep->arr_airport->name }} / {{$pirep->arr_airport->icao}}</a>
              {{ Form::hidden('arr_airport_id') }}
            @else
              {{ Form::select('arr_airport_id', $airport_list, null, [
                      'class' => 'custom-select select2',
                      'style' => 'width: 100%',
                      'readonly' => (!empty($pirep) && $pirep->read_only),
              ]) }}
            @endif
          </div>
        </div>
      </div>
      @if($errors->first('dpt_airport_id') || $errors->first('arr_airport_id'))
        <div class="card-footer p-1 text-left">
          <span class="text-danger p-0 m-0">{{ $errors->first('dpt_airport_id') }}</span>
          <span class="text-danger p-0 m-0 float-right">{{ $errors->first('arr_airport_id') }}</span>
        </div>
      @endif
    </div>

    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('pireps.aircraftinformations')
          <i class="fab fa-avianex float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1">
        <div class="row row-cols-3">
          <div class="col">
            {{ Form::label('aircraft_id', __('common.aircraft')) }}
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ $pirep->aircraft->registration }} @if($pirep->aircraft->name <> $pirep->aircraft->registration) / {{ $pirep->aircraft->name }} @endif</p>
              {{ Form::hidden('aircraft_id') }}
            @else
              {{-- You probably don't want to change this ID if you want the fare select to work --}}
              {{ Form::select('aircraft_id', $aircraft_list, null, [
                  'id' => 'aircraft_select',
                  'class' => 'custom-select select2',
                  'readonly' => (!empty($pirep) && $pirep->read_only),
                  ]) }}
            @endif
          </div>
          <div class="col">
            {{ Form::label('block_fuel', __('pireps.block_fuel')) }} ({{setting('units.fuel')}})
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ $pirep->block_fuel }}</p>
            @else
                {{ Form::number('block_fuel', null, [
                    'class' => 'form-control form-control-sm',
                    'min' => '0',
                    'step' => '100',
                    'readonly' => (!empty($pirep) && $pirep->read_only),
                    ]) }}
            @endif
          </div>
          <div class="col">
            {{ Form::label('fuel_used', __('pireps.fuel_used')) }} ({{setting('units.fuel')}})
            @if(!empty($pirep) && $pirep->read_only)
              <p>{{ $pirep->fuel_used }}</p>
            @else
                {{ Form::number('fuel_used', null, [
                    'class' => 'form-control form-control-sm',
                    'min' => '0',
                    'step' => '50',
                    'readonly' => (!empty($pirep) && $pirep->read_only),
                    ]) }}
            @endif
          </div>
        </div>
      </div>
      @if( $errors->first('aircraft_id') || $errors->first('block_fuel') || $errors->first('fuel_used'))
        <div class="card-footer p-1 text-center">
          <span class="text-danger m-0 p-0 float-right">{{ $errors->first('fuel_used') }}</span>
          <span class="text-danger m-0 p-0">{{ $errors->first('block_fuel') }}</span>
          <span class="text-danger m-0 p-0 float-left">{{ $errors->first('aircraft_id') }}</span>
        </div>
      @endif
    </div>

    <div id="fares_container">@include('pireps.fares')</div>

    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('flights.route')
          <i class="fas fa-route float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1">
          {{ Form::textarea('route', null, [
                  'class' => 'form-control',
                  'placeholder' => __('flights.route'),
                  'rows' => 2,
                  'readonly' => (!empty($pirep) && $pirep->read_only),
            ]) }}
      </div>
      @if($errors->first('route'))
        <div class="card-footer text-right p-1"><p class="text-danger m-0 p-0">{{ $errors->first('route') }}</p></div>
      @endif
    </div>

    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          {{ trans_choice('common.remark', 2) }}
          <i class="far fa-comments float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1">
        {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => trans_choice('common.note', 2)]) }}
      </div>
      @if($errors->first('notes'))
        <div class="card-footer p-1"><p class="text-danger m-0 p-0">{{ $errors->first('notes') }}</p></div>
      @endif
    </div>
  </div>

  <div class="col">
  {{-- Write out the custom fields, and label if they're required --}}
    @if($pirep_fields->count())
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            {{ trans_choice('common.field', 2) }}
            <i class="fab fa-wpforms float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm table-borderless table-striped mb-0">
            @if(isset($pirep) && $pirep->fields)
              @each('pireps.custom_fields', $pirep->fields, 'field')
            @else
              @each('pireps.custom_fields', $pirep_fields, 'field')
            @endif
          </table>
        </div>
      </div>
    @endif

    @if(Dispo_Modules('DisposableTools'))
      @widget('Modules\DisposableTools\Widgets\FlightTimeMultiplier')
    @endif

    <div class="card bg-transparent border-0 shadow-none mb-2">
      <div class="card-footer bg-transparent border-0 p-1 text-right">
        {{ Form::hidden('flight_id') }}
        {{ Form::hidden('sb_id', $simbrief_id) }}

        @if(isset($pirep) && !$pirep->read_only)
          {{ Form::button(__('pireps.deletepirep'), [
                'name' => 'submit',
                'value' => 'Delete',
                'class' => 'btn btn-sm btn-warning',
                'type' => 'submit'])
          }}
        @endif

        {{ Form::button(__('pireps.savepirep'), [
              'name' => 'submit',
              'value' => 'Save',
              'class' => 'btn btn-sm btn-info',
              'type' => 'submit'])
        }}

        @if(!isset($pirep) || (filled($pirep) && !$pirep->read_only))
          {{ Form::button(__('pireps.submitpirep'), [
                'name' => 'submit',
                'value' => 'Submit',
                'class' => 'btn btn-sm btn-success',
                'type' => 'submit'])
          }}
        @endif
      </div>
    </div>
  </div>
</div>
