<div class="row row-cols-2">
  <div class="col col-7">
    {{-- Row : Basic Data --}}
    <div class="row row-cols-4">
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              @if(isset($simbrief->flight->airline))
                {{ $simbrief->flight->airline->code }}
              @elseif(isset($simbrief->pirep->airline))
                {{ $simbrief->pirep->airline->code }}
              @else
                {{ $simbrief->xml->general->icao_airline }}
              @endif
              {{ $simbrief->xml->general->flight_number }}
            </h6>
          </div>
          <div class="card-footer p-1">@lang('flights.flightnumber')</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ $simbrief->xml->atc->callsign }}</h6></div>
          <div class="card-footer p-1">@lang('flights.callsign')</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ $simbrief->xml->aircraft->reg }}</h6></div>
          <div class="card-footer p-1">@lang('disposable.registration')</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ $simbrief->xml->aircraft->name }}</h6></div>
          <div class="card-footer p-1">@lang('disposable.type')</div>
        </div>
      </div>
    </div>
    {{-- Row : Aerodromes --}}
    <div class="row row-cols-4">
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              <span title="{{ $simbrief->xml->origin->name }}">
                {{ $simbrief->xml->origin->icao_code }} / Rwy.{{ $simbrief->xml->origin->plan_rwy }}
              </span>
            </h6>
          </div>
          <div class="card-footer p-1">@lang('disposable.origin')</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              <span title="{{ $simbrief->xml->destination->name }}">
                {{ $simbrief->xml->destination->icao_code }} / Rwy.{{ $simbrief->xml->destination->plan_rwy }}
              </span>
            </h6>
          </div>
          <div class="card-footer p-1">@lang('disposable.destination')</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              @if($simbrief->xml->alternate)
                <span title="{{ $simbrief->xml->alternate->name }}">
                  {{ $simbrief->xml->alternate->icao_code }} / Rwy.{{ $simbrief->xml->alternate->plan_rwy }}
                </span>
              @else
                NO ALTN
              @endif
            </h6>
          </div>
          <div class="card-footer p-1">@lang('disposable.alternate')</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">@minutestotime($simbrief->xml->times->est_time_enroute / 60)</h6></div>
          <div class="card-footer p-1">EET</div>
        </div>
      </div>
    </div>
    {{-- Row : Weights --}}
    <div class="row row-cols-4">
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ $simbrief->xml->weights->payload }} {{ $simbrief->xml->params->units }}</h6></div>
          <div class="card-footer p-1">Est.Payload</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              <span title="MAX: {{ $simbrief->xml->weights->max_zfw }} {{ $simbrief->xml->params->units }}">
                {{ $simbrief->xml->weights->est_zfw }} {{ $simbrief->xml->params->units }}
              </span>
            </h6>
          </div>
          <div class="card-footer p-1">Est.ZFW</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              <span title="MAX: {{ $simbrief->xml->weights->max_tow }} {{ $simbrief->xml->params->units }}">
                {{ $simbrief->xml->weights->est_tow }} {{ $simbrief->xml->params->units }}
              </span>
            </h6>
          </div>
          <div class="card-footer p-1">Est.TOW</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              <span title="MAX: {{ $simbrief->xml->weights->max_ldw }} {{ $simbrief->xml->params->units }}">
                {{ $simbrief->xml->weights->est_ldw }} {{ $simbrief->xml->params->units }}
              </span>
            </h6>
          </div>
          <div class="card-footer p-1">Est.LW</div>
        </div>
      </div>
    </div>
    {{-- Row : Fuels --}}
    <div class="row row-cols-4">
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ Dispo_Round($simbrief->xml->fuel->plan_ramp, 100) }} {{ $simbrief->xml->params->units }}</h6></div>
          <div class="card-footer p-1">Min.Block Fuel</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ Dispo_Round($simbrief->xml->fuel->enroute_burn, 10) }} {{ $simbrief->xml->params->units }}</h6></div>
          <div class="card-footer p-1">Trip Fuel</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ Dispo_Round($simbrief->xml->fuel->plan_landing, 10) }} {{ $simbrief->xml->params->units }}</h6></div>
          <div class="card-footer p-1">Landing Fuel</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              <span title="ALTN: {{$simbrief->xml->fuel->alternate_burn}} + FINAL RES: {{$simbrief->xml->fuel->reserve}}">
                {{ Dispo_Round(($simbrief->xml->fuel->reserve + $simbrief->xml->fuel->alternate_burn), 10) }} {{ $simbrief->xml->params->units }}
              </span>
            </h6>
          </div>
          <div class="card-footer p-1"><span title="FMC Reserve">Min Diversion</span></div>
        </div>
      </div>
    </div>
    {{-- Row : FMC Info --}}
    <div class="row row-cols-4">
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ $simbrief->xml->general->initial_altitude }}</h6></div>
          <div class="card-footer p-1">Init. Altitude</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ $simbrief->xml->general->cruise_profile }}</h6></div>
          <div class="card-footer p-1">CRZ Fuel Policy</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              <span title="AVG WIND COMP: {{ $simbrief->xml->general->avg_wind_comp }}">
                {{ $simbrief->xml->general->avg_wind_dir }}/{{ $simbrief->xml->general->avg_wind_spd }}
              </span>
            </h6>
          </div>
          <div class="card-footer p-1">Avg.CRZ WIND</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ $simbrief->xml->general->avg_temp_dev }}</h6></div>
          <div class="card-footer p-1">CRZ ISA DEV</div>
        </div>
      </div>
    </div>
    {{-- Row : Remarks --}}
    <div class="row row-cols-2">
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              @if(!empty($simbrief->xml->general->dx_rmk))
                @foreach($simbrief->xml->general->dx_rmk as $dx_rmk)
                  @if(!$loop->first)<br>@endif
                  {{ $dx_rmk }}
                @endforeach
              @else
                NIL
              @endif
            </h6>
          </div>
          <div class="card-footer p-1">Dispatch Remarks</div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1">
            <h6 class="m-1 p-0">
              @if(!empty($simbrief->xml->general->sys_rmk))
                @foreach($simbrief->xml->general->sys_rmk as $sys_rmk)
                  @if(!$loop->first)<br>@endif
                  {{ $sys_rmk }}
                @endforeach
              @else
                NIL
              @endif
            </h6>
          </div>
          <div class="card-footer p-1">System Remarks</div>
        </div>
      </div>
    </div>
    {{-- Row : Route --}}
    <div class="row row-cols-1">
      <div class="col">
        <div class="card mb-2 text-center">
          <div class="card-body p-1"><h6 class="m-1 p-0">{{ strstr($simbrief->xml->atc->route, " ") }}</h6></div>
          <div class="card-footer p-1">Route</div>
        </div>
      </div>
    </div>
  </div>
  @php
    $crew_count = 0;
    if($simbrief->xml->crew->cpt) { $crew_count++; }
    if($simbrief->xml->crew->fo) { $crew_count++; }
    if($simbrief->xml->crew->pu) { $crew_count++; }
    $crew_count = $crew_count + count($simbrief->xml->crew->fa);
  @endphp
  <div class="col col-5">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          ATC Flight Plan
          <i class="fas fa-plane float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1" style="font-family: Verdana, sans-serif; font-size: 0.80rem;">
        {!!  str_replace("\n", "<br>", $simbrief->xml->atc->flightplan_text) !!}
      </div>
      <div class="card-footer p-1">
        @if(Theme::getSetting('sbrief_poscon'))
          <div class="float-right">
            <a href="{{ $simbrief->xml->poscon_prefile }}" target="_blank" class="btn btn-sm btn-primary ml-1">@lang('disposable.atcposcon')</a>
          </div>
        @endif
        @if(Theme::getSetting('sbrief_vatsim'))
          <div class="float-right">
            <form action="https://my.vatsim.net/pilots/flightplan" method="GET" target="_blank">
              <input type="hidden" name="raw" value="{{ $simbrief->xml->atc->flightplan_text }}">
              <input type="hidden" name="fuel_time" value="@secstohhmm($simbrief->xml->times->endurance)">
              <input type="hidden" name="speed" value="@if(substr($simbrief->xml->atc->initial_spd,0,1) === '0'){{ substr($simbrief->xml->atc->initial_spd,1) }}@else{{ $simbrief->xml->atc->initial_spd }}@endif">
              <input type="hidden" name="altitude" value="{{ $simbrief->xml->general->initial_altitude }}">
              <input id="vatsim_prefile" type="submit" class="btn btn-sm btn-primary ml-1" value="@lang('disposable.atcvatsim')"/>
            </form>
          </div>
        @endif
        @if(Theme::getSetting('sbrief_ivao'))
          <div class="float-right">
            <form action="https://fpl.ivao.aero/api/fp/load" method="POST" target="_blank">
              <input type="hidden" name="CALLSIGN" value="{{ $simbrief->xml->atc->callsign }}"/>
              <input type="hidden" name="RULES" value="I"/>
              <input type="hidden" name="FLIGHTTYPE" value="N"/>
              <input type="hidden" name="NUMBER" value="1"/>
              <input type="hidden" name="ACTYPE" value="{{ $simbrief->xml->aircraft->icaocode }}"/>
              <input type="hidden" name="WAKECAT" value="{{ $wakecat }}"/>
              <input type="hidden" name="EQUIPMENT" value="{{ $equipment }}"/>
              <input type="hidden" name="TRANSPONDER" value="{{ $transponder }}"/>
              <input type="hidden" name="DEPICAO" value="{{ $simbrief->xml->origin->icao_code}}"/>
              <input type="hidden" name="DEPTIME" value="{{ date('Hi', $simbrief->xml->times->est_out->__toString()) }}"/>
              <input type="hidden" name="SPEEDTYPE" value="{{ $simbrief->xml->atc->initial_spd_unit }}"/>
              <input type="hidden" name="SPEED" value="{{ $simbrief->xml->atc->initial_spd }}"/>
              <input type="hidden" name="LEVELTYPE" value="{{ $simbrief->xml->atc->initial_alt_unit }}"/>
              <input type="hidden" name="LEVEL" value="{{ $simbrief->xml->atc->initial_alt }}"/>
              <input type="hidden" name="ROUTE" value="{{ $simbrief->xml->general->route_ifps }}"/>
              <input type="hidden" name="DESTICAO" value="{{ $simbrief->xml->destination->icao_code }}"/>
              <input type="hidden" name="EET" value="@secstohhmm($simbrief->xml->times->est_time_enroute)"/>
              <input type="hidden" name="ALTICAO" value="{{ $simbrief->xml->alternate->icao_code}}"/>
              <input type="hidden" name="ALTICAO2" value="{{ $simbrief->xml->alternate2->icao_code}}"/>
              <input type="hidden" name="OTHER" value="{{ $simbrief->xml->atc->section18 }}"/>
              <input type="hidden" name="ENDURANCE" value="@secstohhmm($simbrief->xml->times->endurance)"/>
              <input type="hidden" name="POB" value="{{ round($crew_count + $simbrief->xml->weights->pax_count) }}"/>
              <input id="ivao_prefile" type="submit" class="btn btn-sm btn-primary" value="@lang('disposable.atcivao')"/>
            </form>
          </div>
        @endif
        <div class="float-left">
          <a href="http://skyvector.com/?chart=304&fpl={{ $simbrief->xml->origin->icao_code }} {{ $simbrief->xml->general->route }} {{ $simbrief->xml->destination->icao_code }}"
            target="_blank" class="btn btn-sm btn-info">@lang('disposable.viewskyvector')</a>
        </div>
      </div>
    </div>
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          {{ trans_choice('common.download',2) }}
          <i class="fas fa-download float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1">
        <select id="download_fms_select" class="select2 custom-select mb-1">
          @foreach($simbrief->files as $fms)
            <option value="{{ $fms['url'] }}">{{ $fms['name'] }}</option>
          @endforeach
        </select>
      </div>
      <div class="card-footer p-1">
        <input id="download_fms" type="submit" class="btn btn-sm btn-primary float-right" value="{{ trans_choice('common.download',1) }}"/>
      </div>
    </div>
    @if(Theme::getSetting('sbrief_fltcrw'))
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            @lang('disposable.flightcrew')
            <i class="fas fa-users float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          <div class="row row-cols-2">
            <div class="col pr-0">
              <table class="table table-sm table-borderless table-striped mb-0">
                <tr>
                  <th>Captain</th>
                  <td>{{ $simbrief->xml->crew->cpt }}</td>
                </tr>
                <tr>
                  <th>First Officer</th>
                  <td>{{ $simbrief->xml->crew->fo }}</td>
                </tr>
              </table>
            </div>
            <div class="col pl-0">
              <table class="table table-sm table-borderless table-striped mb-0">
                <tr>
                  <th>Purser</th>
                  <td>{{ $simbrief->xml->crew->pu }}</td>
                </tr>
                @foreach($simbrief->xml->crew->fa as $fa)
                  <tr>
                    <th>Flight Attendant</th>
                    <td>{{ $fa }}</td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
        <div class="card-footer p-1 text-right">
          <span class="float-left"><b>Total Crew:</b> {{ $crew_count }}</span>
          <b>Flight Dispatcher:</b> {{ $simbrief->xml->crew->dx }}
        </div>
      </div>
    @endif
    <div class="row row-cols-3">
      <div class="col">{{-- Intentionally Left Blank --}}</div>
      <div class="col">{{-- Intentionally Left Blank --}}</div>
      <div class="col">
        <div class="card mb-2">
          <div class="card-body p-1 text-center">
            <canvas id="qr-code"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@section('scripts')
  @parent
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
  <script>
    var qr;
    (function() {
      qr = new QRious({
        element: document.getElementById('qr-code'),
        size: 100,
        value: "{{ url('/') }}/simbrief/{{$simbrief->id}}"
      });
    })();
  </script>
@endsection
