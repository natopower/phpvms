@extends('app')
@section('title', trans_choice('common.download', 2))
@include('disposable_functions')
@section('content')
  @if(!$grouped_files || \count($grouped_files) === 0)
    <div class="row">
      <div class="alert alert-primary">@lang('downloads.none')</div>
    </div>
  @else
    <ul class="nav nav-pills nav-justified mb-2" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link dispo-pills mr-2 ml-2" id="pills-aircraft-tab" data-toggle="pill" href="#pills-aircraft" role="tab" aria-controls="pills-aircraft" aria-selected="true">@lang('common.aircraft')</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link dispo-pills mr-2 ml-2" id="pills-subfleet-tab" data-toggle="pill" href="#pills-subfleet" role="tab" aria-controls="pills-subfleet" aria-selected="false">@lang('common.subfleet')</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link dispo-pills mr-2 ml-2" id="pills-airport-tab" data-toggle="pill" href="#pills-airport" role="tab" aria-controls="pills-airport" aria-selected="false">@lang('disposable.airport')</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link dispo-pills mr-2 ml-2 active" id="pills-airline-tab" data-toggle="pill" href="#pills-airline" role="tab" aria-controls="pills-airline" aria-selected="false">@lang('common.airline')</a>
      </li>
    </ul>
    {{-- Aircraft Downloads --}}
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade" id="pills-aircraft" role="tabpanel" aria-labelledby="pills-aircraft-tab">
        <div id="DownloadsAircraft" class="row row-cols-3">
          @foreach($grouped_files as $group => $files)
            @if(strpos($group, 'Aircraft >') !== false)
              <div class="col">
                <div class="card mb-2">
                  <div class="card-header p-1"><h5 class="m-1 p-0">{{ substr($group, 11) }}</h5></div>
                  <div class="card-body p-0">
                      @include('downloads.table', ['files' => $files])
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      {{-- Subfleet Downloads --}}
      <div class="tab-pane fade" id="pills-subfleet" role="tabpanel" aria-labelledby="pills-subfleet-tab">
        <div id="DownloadsSubfleet" class="row row-cols-3">
          @foreach($grouped_files as $groupsf => $filessf)
            @if(strpos($groupsf, 'Subfleet >') !== false)
              <div class="col">
                <div class="card mb-2">
                  <div class="card-header p-1"><h5 class="m-1 p-0">{{ substr($groupsf, 11) }}</h5></div>
                  <div class="card-body p-0">
                      @include('downloads.table', ['files' => $filessf])
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      {{-- Airport Downloads --}}
      <div class="tab-pane fade" id="pills-airport" role="tabpanel" aria-labelledby="pills-airport-tab">
        <div id="DownloadsAirport" class="row row-cols-3">
          @foreach($grouped_files as $groupap => $filesap)
            @if(strpos($groupap, 'Airport >') !== false)
              <div class="col">
                <div class="card mb-2">
                    <div class="card-header p-1"><h5 class="m-1 p-0">{{ substr($groupap, 10) }}</h5></div>
                    <div class="card-body p-0">
                        @include('downloads.table', ['files' => $filesap])
                    </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
      {{-- Airline Downloads --}}
      <div class="tab-pane fade show active" id="pills-airline" role="tabpanel" aria-labelledby="pills-airline-tab">
        <div id="DownloadsAirline" class="row row-cols-3">
          @foreach($grouped_files as $groupal => $filesal)
            @if(strpos($groupal, 'Airline >') !== false)
              <div class="col">
                <div class="card mb-2">
                  <div class="card-header p-1"><h5 class="m-1 p-0">{{ substr($groupal, 10) }}</h5></div>
                  <div class="card-body p-0">
                      @include('downloads.table', ['files' => $filesal])
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div>
  @endif
  <style>
    .dispo-pills { background-color: slategray;}
  </style>
@endsection
