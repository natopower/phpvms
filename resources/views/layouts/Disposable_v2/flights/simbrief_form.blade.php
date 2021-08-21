@extends('app')
@section('title', 'SimBrief Flight Planning')
@include('disposable_functions')
@section('content')
  <form id="sbapiform">
    <div class="row">
      <div class="col-8">
        <div class="card mb-2">
          <div class="card-header p-1">
            <h6 class="m-1 p-0">
              @lang('pireps.aircraftinformations')
              <i class="fas fa-plane float-right"></i>
            </h6>
          </div>
          <div class="card-body p-1">
            <div class="row">
              <div class="col">
                <label for="type">@lang('disposable.icaotype')</label>
                <input type="text" class="form-control form-control-sm" value="{{ $aircraft->icao }}" maxlength="4" disabled/>
                <input type="hidden" id="type" name="type" value="{{ $aircraft->subfleet->simbrief_type ?? $aircraft->icao }}">
              </div>
              <div class="col">
                <label for="reg">@lang('disposable.registration')</label>
                <input type="text" class="form-control form-control-sm" value="{{ $aircraft->registration }}" maxlength="6" disabled>
                <input type="hidden" name="reg" value="{{ $aircraft->registration }}">
              </div>
              @if($aircraft->registration != $aircraft->name)
                <div class="col">
                  <label for="acname">@lang('common.name')</label>
                  <input type="text" class="form-control form-control-sm" value="{{ $aircraft->name }}" disabled>
                </div>
              @endif
              @if($aircraft->fuel_onboard > 0)
                <div class="col">
                  <label for="fuel_onboard">@lang('disposable.fuelob')</label>
                  <input type="text" class="form-control form-control-sm" value="{{ Dispo_Fuel($aircraft->fuel_onboard) }}" disabled>
                </div>
              @endif
              @if(Dispo_Modules('DisposableTech') && Theme::getSetting('sb_acspecs'))
                <div class="col">
                  @if(Dispo_GetAcSpecs($aircraft)->count())
                    <label for="addon">Select Aircraft Specs</label>
                    <select id="addon" class="form-control form-control-sm" onchange="ChangeSpecs()">
                      <option value="0" selected>SimBrief Defaults</option>
                      @foreach(Dispo_GetAcSpecs($aircraft) as $specs)
                        <option value="{{ Dispo_Specs($specs) }}">{{ $specs->saircraft }}</option>
                      @endforeach
                    </select>
                  @endif
                </div>
              @endif
            </div>
            @if(Dispo_Modules('DisposableTech') && Theme::getSetting('sb_acspecs') && Dispo_GetAcSpecs($aircraft)->count())
              <div id="specs" class="row row-cols-5 mt-2 mb-2">
                <div class="col">
                  <div class="input-group input-group-sm">
                    <div class="input-group-append"><span class="input-group-text">DOW</span></div>
                    <input id="dow" type="text" class="form-control text-right" value="--" disabled/>
                    <div class="input-group-prepend"><span class="input-group-text">{{ setting('units.weight') }}</span></div>
                  </div>
                </div>
                <div class="col">
                  <div class="input-group input-group-sm">
                    <div class="input-group-append"><span class="input-group-text">MZFW</span></div>
                    <input id="mzfw" type="text" class="form-control text-right" value="--" disabled/>
                    <div class="input-group-prepend"><span class="input-group-text">{{ setting('units.weight') }}</span></div>
                  </div>
                </div>
                <div class="col">
                  <div class="input-group input-group-sm">
                    <div class="input-group-append"><span class="input-group-text">MTOW</span></div>
                    <input id="mtow" type="text" class="form-control text-right" value="--" disabled/>
                    <div class="input-group-prepend"><span class="input-group-text">{{ setting('units.weight') }}</span></div>
                  </div>
                </div>
                <div class="col">
                  <div class="input-group input-group-sm">
                    <div class="input-group-append"><span class="input-group-text">MLW</span></div>
                    <input id="mlw" type="text" class="form-control text-right" value="--" disabled/>
                    <div class="input-group-prepend"><span class="input-group-text">{{ setting('units.weight') }}</span></div>
                  </div>
                </div>
                <div class="col">
                  <div class="input-group input-group-sm">
                    <div class="input-group-append"><span class="input-group-text">Fuel Cap</span></div>
                    <input id="maxfuel" type="text" class="form-control text-right" value="--" disabled/>
                    <div class="input-group-prepend"><span class="input-group-text">{{ setting('units.weight') }}</span></div>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>

        <div class="card mb-2">
          <div class="card-header p-1">
            <h6 class="m-1 p-0">
              @lang('pireps.flightinformations') | <b>{{ $flight->airline->icao }}{{ $flight->flight_number }} ({{ \App\Models\Enums\FlightType::label($flight->flight_type) }})</b>
              <i class="fas fa-paper-plane float-right"></i>
            </h6>
          </div>
          <div class="card-body p-1">
            <div class="row mb-1">
              <div class="col">
                <label for="dorig">@lang('common.departure')</label>
                <input name="orig" type="hidden" maxlength="4" value="{{ $flight->dpt_airport_id }}">
                <div class="input-group input-group-sm">
                  <input id="dorig" type="text" class="form-control form-control-sm" maxlength="4" value="{{ $flight->dpt_airport_id }}" disabled>
                  @if(Dispo_Modules('DisposableTech') && Theme::getSetting('sb_runways'))
                    <div class="input-group-append">
                      <select name="origrwy" class="form-control form-control-sm">
                        <option value="">AUTO</option>
                        @foreach(Dispo_GetRunways($flight->dpt_airport_id) as $drunway)
                          <option value="{{ $drunway->runway_ident }}">{!! Dispo_Runway($drunway) !!}</option>
                        @endforeach
                      </select>
                    </div>
                  @endif
                </div>
              </div>
              <div class="col">
                <label for="ddest">@lang('common.arrival')</label>
                <input name="dest" type="hidden" maxlength="4" value="{{ $flight->arr_airport_id }}">
                <div class="input-group input-group-sm">
                  <input id="ddest" type="text" class="form-control form-control-sm" maxlength="4" value="{{ $flight->arr_airport_id }}" disabled>
                  @if(Dispo_Modules('DisposableTech') && Theme::getSetting('sb_runways'))
                    <div class="input-group-append">
                      <select name="destrwy" class="form-control form-control-sm">
                        <option value="">AUTO</option>
                        @foreach(Dispo_GetRunways($flight->arr_airport_id) as $arunway)
                          <option value="{{ $arunway->runway_ident }}">{!! Dispo_Runway($arunway) !!}</option>
                        @endforeach
                      </select>
                    </div>
                  @endif
                </div>
              </div>
              <div class="col-2">
                <label for="altn">@lang('disposable.alternate')</label>
                <input name="altn" type="text" class="form-control form-control-sm" maxlength="4" value="{{ $flight->alt_airport_id ?? 'AUTO' }}">
              </div>
              <div class="col-2">
                <label for="fl">@lang('disposable.preflevel')</label>
                <input id="fl" name="fl" type="number" class="form-control form-control-sm" maxlength="5" min="0" max="99999" step="500" value="{{ $flight->level }}" onchange="CheckFL()">
              </div>
            </div>
            <div class="row mb-1">
              <div class="col">
                <label for="route">@lang('disposable.prefroute')</label>
                <input name="route" type="text" class="form-control form-control-sm" value="{{ $flight->route }}">
              </div>
              @if(Theme::getSetting('sb_routefinder'))
                <div class="col-2">
                  <label for="rfinder">&nbsp;</label>
                  <button id="rfinder" type="button" class="btn btn-sm btn-secondary form-control form-control-sm" data-toggle="modal" data-target="#rfinderModal">RouteFinder</button>
                </div>
              @endif
            </div>
            <div class="row row-cols-4 mb-1">
              <div class="col">
                <label class="pl-1 mb-1" for="dof">@lang('disposable.doffull')</label>
                <input id="dof" type="text" class="form-control form-control-sm" maxlength="9" disabled>
              </div>
              <div class="col">
                <label class="pl-1 mb-1" for="etd">@lang('disposable.etdfull')</label>
                <div class="input-group input-group-sm">
                  <input id="deph" name="deph" type="number" class="form-control form-control-sm text-center" min="0" max="23" maxlength="2">
                  <div class="input-group-append ml-0 mr-0"><span class="input-group-text pr-1 pl-1">:</span></div>
                  <input id="depm" name="depm" type="number" class="form-control form-control-sm text-center" min="0" max="59" maxlength="2">
                </div>
              </div>
              <div class="col">
                @if($flight->dpt_time)
                  <label class="pl-1 mb-1" for="std">@lang('disposable.stdfull')</label>
                  <input type="text" class="form-control form-control-sm" value="{{ $flight->dpt_time }}" disabled>
                @endif
              </div>
              <div class="col">
                @if($flight->arr_time)
                  <label class="pl-1 mb-1" for="std">@lang('disposable.stafull')</label>
                  <input type="text" class="form-control form-control-sm" value="{{ $flight->arr_time }}" disabled>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-2">
          <div class="card-header p-1">
            <h6 class="m-1 p-0">
              @lang('disposable.configandload') | <b>{{ $aircraft->registration }} ({{ $aircraft->subfleet->name }})</b>
              <i class="fas fa-balance-scale float-right"></i>
            </h6>
          </div>
          <div class="card-body p-1">
            <div class="row row-cols-4 mb-1">
              {{-- Pax Fares --}}
                @foreach($pax_load_sheet as $pfare)
                  <div class="col">
                    <label for="LoadFare{{ $pfare['id'] }}">{{ $pfare['name'] }} [@lang('disposable.max'): {{ $pfare['capacity'] }}]</label>
                    <input id="LoadFare{{ $pfare['id'] }}" type="text" class="form-control form-control-sm" value="{{ $pfare['count'] }}" disabled>
                  </div>
                @endforeach
              {{-- Cargo Fares --}}
                @foreach($cargo_load_sheet as $cfare)
                  <div class="col">
                    <label for="LoadFare{{ $cfare['id'] }}">
                      {{ $cfare['name'] }}
                      @if($tbagload > 0)
                        [@lang('disposable.maxavail'):
                      @else
                        [@lang('disposable.max'):
                      @endif
                      {{ number_format($cfare['capacity'] - $tbagload) }} {{ setting('units.weight') }}]
                    </label>
                    <input id="LoadFare{{ $cfare['id'] }}" type="text" class="form-control form-control-sm" value="{{ number_format($cfare['count']) }} {{ setting('units.weight') }}" disabled>
                  </div>
                @endforeach
            </div>
            @if(isset($tpayload) && $tpayload > 0)
              {{-- Display The Weights Generated --}}
              <div class="row row-cols-4 mb-1">
                @if($tpaxload)
                  <div class="col">
                    <label for="tdPaxLoad">@lang('disposable.paxw')</label>
                    <input id="tdPaxLoad" type="text" class="form-control form-control-sm" value="{{ number_format($tpaxload) }} {{ setting('units.weight') }}" disabled>
                  </div>
                  <div class="col">
                    <label for="tdBagLoad">@lang('disposable.bagw')</label>
                    <input id="tdBagLoad" type="text" class="form-control form-control-sm" value="{{ number_format($tbagload) }} {{ setting('units.weight') }}" disabled>
                  </div>
                @endif
                @if($tpaxload && $tcargoload)
                  <div class="col">
                    <label for="tdCargoLoad">@lang('disposable.cgow')</label>
                    <input id="tdCargoLoad" type="text" class="form-control form-control-sm" value="{{ number_format($tcargoload) }} {{ setting('units.weight') }}" disabled>
                  </div>
                @endif
                <div class="col">
                  <label for="tdPayload">@lang('disposable.tpayload')</label>
                  <input id="tdPayload" type="text" class="form-control form-control-sm" value="{{ number_format($tpayload) }} {{ setting('units.weight') }}" disabled>
                </div>
              </div>
            @endif
          </div>
        </div>
        @if(Theme::getSetting('sb_wxreports'))
          <div class="row">
            <div class="col">{{ Widget::Weather(['icao' => $flight->dpt_airport_id, 'raw_only' => true]) }}</div>
            <div class="col">{{ Widget::Weather(['icao' => $flight->arr_airport_id, 'raw_only' => true]) }}</div>
          </div>
        @endif
      </div>

      <div class="col-4">
        <div class="card mb-2">
          <div class="card-header p-1">
            <h6 class="m-1 p-0">
              @lang('disposable.planoptions')
              <i class="fas fa-tasks float-right"></i>
            </h6>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped mb-0">
              <tr>
                <td class="align-middle" style="width: 30%;">@lang('disposable.cfuelpolicy'):</td>
                <td class="align-middle">
                  <select id="cruise" name="cruise" class="form-control form-control-sm" onchange="DisableCI()">
                    <option value="LRC">@lang('disposable.lrc')</option>
                    <option value="CI" selected>@lang('disposable.ci')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.ci'):</td>
                <td class="align-middle"><input type="text" id="civalue" name="civalue" class="form-control form-control-sm" maxlength="4" value="AUTO"></td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.contfuel'):</td>
                <td class="align-middle">
                  <select name="contpct" class="form-control form-control-sm">
                    <option value="0">None</option>
                    <option value="auto">AUTO</option>
                    <option value="easa">EASA</option>
                    <option value="0.03/5">3% or 05 MIN</option>
                    <option value="0.03/10">3% or 10 MIN</option>
                    <option value="0.03/15">3% or 15 MIN</option>
                    <option value="0.05/5" selected>5% or 05 MIN</option>
                    <option value="0.05/10">5% or 10 MIN</option>
                    <option value="0.05/15">5% or 15 MIN</option>
                    <option value="0.03">3%</option>
                    <option value="0.05">5%</option>
                    <option value="0.1">10%</option>
                    <option value="0.15">15%</option>
                    <option value="3">03 MIN</option>
                    <option value="5">05 MIN</option>
                    <option value="10">10 MIN</option>
                    <option value="15">15 MIN</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.resvfuel'):</td>
                <td class="align-middle">
                  <select name="resvrule" class="form-control form-control-sm">
                    <option value="auto">AUTO</option>
                    <option value="0">0 MIN</option>
                    <option value="15">15 MIN</option>
                    <option value="30" selected>30 MIN</option>
                    <option value="45">45 MIN</option>
                    <option value="60">60 MIN</option>
                    <option value="75">75 MIN</option>
                    <option value="90">90 MIN</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.sidstar'):</td>
                <td class="align-middle">
                  <select id="sidstar" class="form-control form-control-sm" onchange="SidStarSelection()">
                    <option value="C">Conventional</option>
                    <option value="R" selected>RNAV</option>
                    <option value="NIL">@lang('disposable.disabled')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.stepclimbs'):</td>
                <td class="align-middle">
                  <select id="stepclimbs" name="stepclimbs" class="form-control form-control-sm" onchange="DisableFL()">
                    <option value="0" selected>@lang('disposable.disabled')</option>
                    <option value="1">@lang('disposable.enabled')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.etopsplanning'):</td>
                <td class="align-middle">
                  <select name="etops" class="form-control form-control-sm">
                    <option value="0" selected>@lang('disposable.disabled')</option>
                    <option value="1">@lang('disposable.enabled')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.altnaps'):</td>
                <td class="align-middle">
                  <select name="altn_count" class="form-control form-control-sm">
                    <option value="1">1</option>
                    <option value="2" selected>2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header p-1">
            <h6 class="m-1 p-0">
              @lang('disposable.briefoptions')
              <i class="fas fa-file-pdf float-right"></i>
            </h6>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped mb-0">
              <tr>
                <td class="align-middle" style="width: 30%;">@lang('disposable.ofpunits'):</td>
                <td class="align-middle">
                  <select id="ofp_weights" name="units" class="form-control form-control-sm" onchange="ConvertWeights()">
                    @if(setting('units.weight') === 'kg')
                      <option value="KGS" selected>KGS</option>
                      <option value="LBS">LBS</option>
                    @else
                      <option value="KGS">KGS</option>
                      <option value="LBS" selected>LBS</option>
                    @endif
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.ofpformat'):</td>
                <td class="align-middle">
                  <select name="planformat" class="form-control form-control-sm">
                    <option value="lido" selected>Lido</option>
                    <option value="ber">Air Berlin</option>
                    <option value="baw">British Airways</option>
                    <option value="ezy">Easy Jet</option>
                    <option value="gwi">German Wings</option>
                    <option value="klm">KLM</option>
                    <option value="dlh">Lufthansa</option>
                    <option value="qfa">Quantas</option>
                    <option value="ryr">Ryan Air</option>
                    <option value="thy">SunExpress</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.navlog'):</td>
                <td class="align-middle">
                  <select name="navlog" class="form-control form-control-sm">
                    <option value="0">@lang('disposable.disabled')</option>
                    <option value="1" selected>@lang('disposable.enabled')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.tlr'):</td>
                <td class="align-middle">
                  <select name="tlr" class="form-control form-control-sm">
                    <option value="0">@lang('disposable.disabled')</option>
                    <option value="1" selected>@lang('disposable.enabled')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.aptnotams'):</td>
                <td class="align-middle">
                  <select name="notams" class="form-control form-control-sm">
                    <option value="0">@lang('disposable.disabled')</option>
                    <option value="1" selected>@lang('disposable.enabled')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.firnotams'):</td>
                <td class="align-middle">
                  <select name="firnot" class="form-control form-control-sm">
                    <option value="0" selected>@lang('disposable.disabled')</option>
                    <option value="1">@lang('disposable.enabled')</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="align-middle">@lang('disposable.ofpmaps'):</td>
                  <td class="align-middle">
                    <select name="maps" class="form-control form-control-sm">
                      <option value="detail" selected>Detailed</option>
                      <option value="simple">Simple</option>
                      <option value="none">None</option>
                    </select>
                  </td>
              </tr>
            </table>
          </div>
        </div>
        @if(Theme::getSetting('sb_extrafuel'))
          <div class="card mb-2">
            <div class="card-header p-1">
              <h6 class="m-1 p-0">
                @lang('disposable.extrafuel')
                <i class="fas fa-gas-pump float-right"></i>
              </h6>
            </div>
            <div class="card-body p-1">
              <div class="row">
                @if(Theme::getSetting('sb_tankering'))
                  <div class="col">
                    {!! Dispo_Tankering($flight,$aircraft) !!}
                  </div>
                @endif
                <div class="col text-right">
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <div class="input-group-text">@if(setting('units.fuel') === 'kg') Metric @else Imperial @endif Tonnes</div>
                    </div>
                    <input id="addedfuel" name="addedfuel" type="number" class="form-control form-control-sm" placeholder="0,0" min="0" max="60" step="0.1" maxlength="4"/>
                  </div>
                  <input type='hidden' name="addedfuel_units" value="wgt">
                </div>
              </div>
            </div>
          </div>
        @endif

        {{-- Prepare Rest of the Form Fields For SimBrief --}}
        @php
          // Get RVR and Remark Text From Theme Settings with some failsafe defaults,
          // Below two variables are also used when DisposableTech module is installed and activated.
          if(filled(Theme::getSetting('sb_rvr'))) { $sb_rvr = Theme::getSetting('sb_rvr');} else { $sb_rvr = '500';}
          if(filled(Theme::getSetting('sb_rmk'))) { $sb_rmk = Theme::getSetting('sb_rmk');} else { $sb_rmk = strtoupper(config('app.name'));}
        @endphp
          {{-- If Disposable Tech Module is installed and activated, Specs will overwrite below two form fields according to your defined AC Specifications and selections --}}
          {{-- Below value fields are just defaults and should remain in the form --}}
          <input type="hidden" id="acdata" name="acdata" value="{'extrarmk':'RVR/{{ $sb_rvr }} RMK/TCAS {{ $sb_rmk }}','paxwgt':{{ round($pax_weight + $bag_weight) }}}" readonly>
          <input type="hidden" id="fuelfactor" name="fuelfactor" value="" readonly>
          @if($tpaxfig)
            <input type="hidden" name="pax" value="{{ $tpaxfig }}">
          @elseif(!$tpaxfig && $tcargoload)
            <input type="hidden" name="pax" value="0">
          @endif
          @if($tcargoload)
            <input type='hidden' id='cargo' name='cargo' value="{{ number_format(($tcargoload / 1000),1) }}">
          @endif
          @if(isset($tpayload) && $tpayload > 0)
            <input type="hidden" name="manualrmk" value="Load Distribution {{ $loaddist }}">
          @endif
          <input type="hidden" name="airline" value="{{ $flight->airline->icao }}">
          <input type="hidden" name="fltnum" value="{{ $flight->flight_number }}">
          @if(setting('simbrief.callsign', false))
            <input type="hidden" name="callsign" value="{{ $user->ident }}">
          @elseif(filled($flight->callsign))
            <input type="hidden" name="callsign" value="{{ $flight->airline->icao }}{{ $flight->callsign }}">
          @endif
          @if(setting('simbrief.name_private', false))
            <input type="hidden" name="cpt" value="{{ $user->name_private }}">
          @endif
          <input type="hidden" id="steh" name="steh" maxlength="2">
          <input type="hidden" id="stem" name="stem" maxlength="2">
          <input type="hidden" id="date" name="date" maxlength="9">
          <input type="hidden" id="selcal" name="selcal" value="BK-FS">
          <input type="hidden" id="omit_sids" name="omit_sids" value="0">
          <input type="hidden" id="omit_stars" name="omit_stars" value="0">
          <input type="hidden" id="find_sidstar" name="find_sidstar" value="R">
          <input type="hidden" id="static_id" name="static_id" value="{{ $static_id }}">
        {{-- For more info about form fields and their details check SimBrief Forum / API Support --}}

        <div class="card bg-transparent mb-2 p-0 text-right border-0">
          <input type="button" class="btn btn-primary" value="@lang('disposable.generateofp')"
              onclick="simbriefsubmit('{{ $flight->id }}', '{{ $aircraft->id }}', '{{ url(route('frontend.simbrief.briefing', [''])) }}');">
        </div>
      </div>
    </div>
  </form>

@if(Theme::getSetting('sb_routefinder'))
  @include('flights.simbrief_routefinder')
@endif

@endsection
@include('flights.simbrief_scripts')
