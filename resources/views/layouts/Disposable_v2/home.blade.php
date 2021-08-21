@extends('app')
@section('title', __('home.welcome.title'))
@include('disposable_functions')
@section('content')
  {{-- First Row Of Home --}}
  <div class="row mb-2">
    <div class="col">{{-- You Can Use This Area For Anything You Wish --}}</div>
  </div>

  {{-- Second Row To Show Our Latest Pilots --}}
  <h4 class="card-title">@lang('common.newestpilots')</h4>
  <div class="row row-cols-4 mb-2">
    @foreach($users as $user)
      <div class="col">
        <div class="card mb-2">
          <div class="card-header p-1 text-center">
            <h5 class="m-0 p-0">{{ $user->name_private }} @if(filled($user->home_airport_id)) ({{ $user->home_airport->icao }}) @endif</h5>
          </div>
          <div class="card-body p-1 text-center">
            @if ($user->avatar === null)
              <img class="rounded img-r50 border border-dark" src="{{ public_asset('/disposable/nophoto.jpg') }}"/>
            @else
              <img class="rounded img-r50 border border-dark" src="{{ $user->avatar->url }}">
            @endif
          </div>
          <div class="card-footer p-1 text-center">
            <a href="{{ route('frontend.profile.show', [$user->id]) }}" class="btn btn-info btn-sm">@lang('common.profile')</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  {{-- Third Row For Some Disposable Widgets --}}
  @if(Dispo_Modules('DisposableTools'))
    <div class="row row-cols-3 mb-2">
      <div class="col">
        @widget('Modules\DisposableTools\Widgets\TopPilots', ['type' => 'time', 'period' => 'lastm', 'count' => 1])
        @widget('Modules\DisposableTools\Widgets\TopPilots', ['type' => 'time', 'count' => 6])
      </div>
      <div class="col">
        @widget('Modules\DisposableTools\Widgets\AirlineStats')
      </div>
      <div class="col">
        @widget('Modules\DisposableTools\Widgets\TopPilots', ['type' => 'distance', 'period' => 'lastm', 'count' => 1])
        @widget('Modules\DisposableTools\Widgets\TopPilots', ['type' => 'distance', 'count' => 6])
      </div>
    </div>
  @endif
@endsection
