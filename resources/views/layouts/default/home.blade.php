@extends('app')
@section('title', __('home.welcome.title'))

@section('content')
  <!--image header--> 
  <div class="mask flex-column" style="width: 100%; background-image: url('https://cdn.discordapp.com/attachments/849693131833999432/880919870009659402/unknown.png')">
    <div class="container" style="padding-bottom: 20em">
      <div style="padding-top: 10%">
        <br>
        <h1 style="font-size: 6em; color: #fff">
          <span class="badge-primary font-weight-bold" style="padding: 1%">welcome aboard, canada.</span>
        </h1>
        <h6 style="font-size: 1.25em; color: #fff;">
            <span class="winnipeg-blue corner" style="padding: 0.5%">Screenshot: Nate P | FLE010</span>
        </h6>
        <br>
      </div>
    </div>
  </div>
  <br>
  <!--add more modules if needed-->
  <div class="row">
    <div class="col-sm-12">
    </div>
  </div>
  <!--newest members-->
  <div class="row">
    <div class="col-sm-12">
      <h2 class="description font-weight-bold text-black">our newest pilots</h2>
      @foreach($users as $user)
        <div class="card card-signup blue-bg mb-2">
          <div class="header header-primary text-center blue-bg">
            <h3 class="title title-up text-white">
              <a href="{{ route('frontend.profile.show', [$user->id]) }}" class="text-white">{{ $user->name_private }}</a>
            </h3>
            <div class="photo-container">
              @if ($user->avatar == null)
                <img class="rounded-circle" src="{{ $user->gravatar(123) }}" style="height: 100px;">
              @else
                <img class="rounded-circle" src="{{ $user->avatar->url }}" style="height: 100px;">
              @endif
            </div>
          </div>
          <div class="content content-center">
            <div class="social-description text-center text-white">
              <br>
              <h3 class="description text-white" style="text-transform: uppercase">
                @if(filled($user->home_airport))
                  {{ $user->home_airport->icao }}
                @endif
              </h3>
            </div>
          </div>
          <div class="footer mb-0 text-center">
            <a href="{{ route('frontend.profile.show', [$user->id]) }}"
               class="btn btn-secondary font-weight-bold btn-sm">@lang('common.profile')</a>
          </div>
        </div>   
      @endforeach
    </div>
  </div>
@endsection
