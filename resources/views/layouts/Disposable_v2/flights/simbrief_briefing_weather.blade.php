<div class="row row-cols-2">
  <div class="col-3">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('disposable.origin')
          <i class="fas fa-cloud-moon-rain float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1 mb-0">
        <p class="small p-0 mb-1"><b>METAR</b></p>
        <p class="small p-0">{{ $simbrief->xml->weather->orig_metar }}</p>
        <p class="small p-0 mb-1"><b>TAF</b></p>
        <p class="small p-0">{{ $simbrief->xml->weather->orig_taf }}</p>
      </div>
    </div>

    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('disposable.destination')
          <i class="fas fa-cloud-moon-rain float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1 mb-0">
        <p class="small p-0 mb-1"><b>METAR</b></p>
        <p class="small p-0">{{ $simbrief->xml->weather->dest_metar }}</p>
        <p class="small p-0 mb-1"><b>TAF</b></p>
        <p class="small p-0">{{ $simbrief->xml->weather->dest_taf }}</p>
      </div>
    </div>

    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('disposable.alternate')
          <i class="fas fa-cloud-moon-rain float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1 mb-0">
        <p class="small p-0 mb-1"><b>METAR</b></p>
        <p class="small p-0">{{ $simbrief->xml->weather->altn_metar }}</p>
        <p class="small p-0 mb-1"><b>TAF</b></p>
        <p class="small p-0">{{ $simbrief->xml->weather->altn_taf }}</p>
      </div>
    </div>
  </div>
  <div class="col-9">
    <div class="card mb-2">
      <div class="card-header p-0">
        <nav>
          <h5 class="m-0 p-0">
            <i class="fas fa-cloud-sun-rain float-right mt-2 mr-1 p-1"></i>
            <div class="nav nav-tabs m-0 p-0 border-0" id="nav-tab" role="tablist">
              <a class="nav-link m-1 p-1 border-0 active" id="nav-origin-tab" data-toggle="tab" href="#nav-origin" role="tab" 
                  aria-controls="nav-origin" aria-selected="true">@lang('disposable.origin') @lang('disposable.livewx')</a>
              <a class="nav-link m-1 p-1 border-0" id="nav-destination-tab" data-toggle="tab" href="#nav-destination" role="tab" 
                  aria-controls="nav-destination" aria-selected="false">@lang('disposable.destination') @lang('disposable.livewx')</a>
            </div>
          </h5>
        </nav>
      </div>
      <div class="card-body p-0">
        <div class="tab-content text-center" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-origin" role="tabpanel" aria-labelledby="nav-origin-tab">
            <iframe id="windyframe" class="mb-0" height="700px" width="100%"
            src="https://embed.windy.com/embed2.html?lat={{ $simbrief->xml->origin->pos_lat }}&lon={{ $simbrief->xml->origin->pos_long }}&detailLat={{ $simbrief->xml->origin->pos_lat }}&detailLon={{  $simbrief->xml->origin->pos_long }}&zoom=6&level=surface&overlay=thunder&product=ecmwf&marker=true&message=true&calendar=now&pressure=true&type=map&location=coordinates&metricWind=kt&metricTemp=%C2%B0C&radarRange=-1"
            frameborder="0"></iframe>
          </div>
          <div class="tab-pane fade" id="nav-destination" role="tabpanel" aria-labelledby="nav-destination-tab">
            <iframe id="windyframe" class="mb-0" height="700px" width="100%"
            src="https://embed.windy.com/embed2.html?lat={{ $simbrief->xml->destination->pos_lat }}&lon={{ $simbrief->xml->destination->pos_long }}&detailLat={{ $simbrief->xml->destination->pos_lat }}&detailLon={{ $simbrief->xml->destination->pos_long }}&zoom=6&level=surface&overlay=thunder&product=ecmwf&marker=true&message=true&calendar=now&pressure=true&type=map&location=coordinates&metricWind=kt&metricTemp=%C2%B0C&radarRange=-1"
            frameborder="0"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
