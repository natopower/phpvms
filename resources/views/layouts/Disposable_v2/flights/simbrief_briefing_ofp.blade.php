<div class="row">
  <div class="col-3" style="max-width: 495px; min-width: 495px; width: 495px;">
    {{-- OFP with fixed Width to save space --}}
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="m-1 p-0">
          @lang('disposable.ofpfull')
          <i class="fas fa-file-pdf float-right"></i>
        </h5>
      </div>
      <div class="card-body p-1 overflow-auto" style="max-height: 850px;">
        @if($simbrief->xml->params->units == 'lbs' && setting('units.weight') === 'kg' || $simbrief->xml->params->units == 'kgs' && setting('units.weight') === 'lbs' )
          <p class="small text-uppercase p-1 mb-1"><b>*** ALL WEIGHTS IN {{ $simbrief->xml->params->units }} ***</b></p>
        @endif
        {!! $simbrief->xml->text->plan_html !!}
      </div>
    </div>
  </div>
  <div class="col" style="max-width: auto; min-width: auto; width:auto;">
    {{-- Wider Area for Maps and WX --}}
    <div class="card mb-2">
      <div class="card-header p-0">
        <nav>
          <h5 class="m-0 p-0">
            <i class="fas fa-map float-right mt-2 mr-1 p-1"></i>
            <div class="nav nav-tabs m-0 p-0 border-0" id="nav-tab" role="tablist">
              <a class="nav-link m-1 p-1 border-0 active" id="nav-route-tab" data-toggle="tab" href="#nav-route" role="tab" aria-controls="nav-route" aria-selected="true">Route & Vertical Profile</a>
              <a class="nav-link m-1 p-1 border-0" id="nav-sigwx-tab" data-toggle="tab" href="#nav-sigwx" role="tab" aria-controls="nav-sigwx" aria-selected="false">SigWX Maps</a>
              <a class="nav-link m-1 p-1 border-0" id="nav-uad-tab" data-toggle="tab" href="#nav-uad" role="tab" aria-controls="nav-uad" aria-selected="false">UAD Maps</a>
            </div>
          </h5>
        </nav>
      </div>
      <div class="card-body p-1">
        <div class="tab-content text-center" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-route" role="tabpanel" aria-labelledby="nav-route-tab">
            @foreach($simbrief->images as $image)
              @if($image['name'] === 'Route' || $image['name'] === 'Vertical profile')
                <img class="rounded" src="{{ $image['url'] }}" alt="{{ $image['name'] }}" style="max-width: 90%;"/>
                <p class="mb-2 text-muted">{{ $image['name'] }}</p>
              @endif
            @endforeach
          </div>
          <div class="tab-pane fade" id="nav-sigwx" role="tabpanel" aria-labelledby="nav-sigwx-tab">
            @foreach($simbrief->images as $image)
              @if(strpos($image['name'], 'SigWx') !== false)
                <img class="rounded" src="{{ $image['url'] }}" alt="{{ $image['name'] }}" style="max-width: 90%;"/>
                <p class="mb-2 text-muted">{{ $image['name'] }}</p>
              @endif
            @endforeach
          </div>
          <div class="tab-pane fade" id="nav-uad" role="tabpanel" aria-labelledby="nav-uad-tab">
            @foreach($simbrief->images as $image)
              @if(strpos($image['name'], 'UAD') !== false)
                <img class="rounded" src="{{ $image['url'] }}" alt="{{ $image['name'] }}" style="max-width: 90%;"/>
                <p class="mb-2 text-muted">{{ $image['name'] }}</p>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
