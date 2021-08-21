@extends('app')
@section('title', 'Briefing')
@include('disposable_functions')
@section('content')
  <ul class="nav nav-pills nav-justified mb-2" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link dispo-pills mr-2 ml-2 active" id="pills-summary-tab" data-toggle="pill" href="#pills-summary" role="tab" aria-controls="pills-summary" aria-selected="true">@lang('disposable.ofpsummary')</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link dispo-pills mr-2 ml-2" id="pills-ofp-tab" data-toggle="pill" href="#pills-ofp" role="tab" aria-controls="pills-ofp" aria-selected="false">@lang('disposable.ofpsigwx')</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link dispo-pills mr-2 ml-2" id="pills-weather-tab" data-toggle="pill" href="#pills-weather" role="tab" aria-controls="pills-weather" aria-selected="false">@lang('disposable.ofpweather')</a>
    </li>
    @if(empty($simbrief->pirep_id) && $user->id == $simbrief->user_id && Theme::getSetting('manual_pireps'))
      <li class="nav-item" role="presentation">
        <a class="nav-link mr-2 ml-2 btn-info" href="{{ url(route('frontend.simbrief.prefile', [$simbrief->id])) }}">@lang('disposable.sbprefilepirep')</a>
      </li>
    @endif
    @if(!empty($simbrief->xml->params->static_id) && $user->id == $simbrief->user_id)
      <li class="nav-item" role="presentation">
        <a class="nav-link mr-2 ml-2 btn-secondary" data-toggle="modal" data-target="#staticBackdrop" href="#">@lang('disposable.sbeditofp')</a>
      </li>
    @endif
    @if(!empty($simbrief->flight_id) && $user->id == $simbrief->user_id && $acars_plugin)
      <li class="nav-item" role="presentation">
        @if(isset($bid))
          <a class="nav-link mr-2 ml-2 btn-success" href="vmsacars:bid/{{ $bid->id }}">@lang('disposable.loadacars')</a>
        @else
          <a class="nav-link mr-2 ml-2 btn-success" href="vmsacars:flight/{{ $simbrief->flight_id }}">@lang('disposable.loadacars')</a>
        @endif
      </li>
    @endif
    @if($user->id == $simbrief->user_id)
      <li class="nav-item" role="presentation">
        <a class="nav-link mr-2 ml-2 btn-danger" href="{{ url(route('frontend.simbrief.generate_new', [$simbrief->id])) }}">@lang('disposable.sbgeneratenew')</a>
      </li>
    @endif
  </ul>
 
  <div class="tab-content" id="pills-tabContent">
    {{-- Summary Tab --}}
    <div class="tab-pane fade show active" id="pills-summary" role="tabpanel" aria-labelledby="pills-summary-tab">
      @include('flights.simbrief_briefing_summary')
    </div>
    {{-- OFP and Weather Maps--}}
    <div class="tab-pane fade" id="pills-ofp" role="tabpanel" aria-labelledby="pills-ofp-tab">
      @include('flights.simbrief_briefing_ofp')
    </div>
    {{-- OFP Weather Section --}}
    <div class="tab-pane fade" id="pills-weather" role="tabpanel" aria-labelledby="pills-weather-tab">
      @include('flights.simbrief_briefing_weather')
    </div>
  </div>

  {{-- SimBrief Edit Modal --}}
  @if(!empty($simbrief->xml->params->static_id))
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog" style="max-width: 1020px;">
        <div class="modal-content card-header shadow-none p-0" style="border-radius: 5px;">
          <div class="modal-header border-0 p-1">
            <h5 class="card-title m-1 p-0">SimBrief</h5>
            <span class="close"><i class="fas fa-times-circle" data-dismiss="modal" aria-label="Close" aria-hidden="true"></i></span>
          </div>
          <div class="modal-body border-0 p-0">
            <iframe src="https://www.simbrief.com/system/dispatch.php?editflight=last&static_id={{ $simbrief->xml->params->static_id }}" style="width: 100%; height: 80vh;" frameBorder="0" title="SimBrief"></iframe>
          </div>
          <div class="modal-footer border-0 text-right p-1">
            <a
              class="btn btn-success btn-sm m-0 p-0 mr-1 ml-2 pl-2 pr-2" 
              href="{{ route('frontend.simbrief.update_ofp') }}?ofp_id={{ $simbrief->id }}&flight_id={{ $simbrief->flight_id }}&aircraft_id={{ $simbrief->aircraft_id }}&sb_userid={{ $simbrief->xml->params->user_id }}&sb_static_id={{ $simbrief->xml->params->static_id }}">
              @lang('disposable.sbdownclose')
            </a>
            <button type="button" class="btn btn-danger btn-sm m-0 p-0 mr-1 ml-2 pl-2 pr-2" data-dismiss="modal">@lang('disposable.close')</button>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection

@section('scripts')
  <script>
    $(document).ready(function () {
      $("#download_fms").click(e => {
        e.preventDefault();
        const select = document.getElementById("download_fms_select");
        const link = select.options[select.selectedIndex].value;
        console.log('Downloading FMS: ', link);
        window.open(link, '_blank');
      });
    });
  </script>
@endsection
