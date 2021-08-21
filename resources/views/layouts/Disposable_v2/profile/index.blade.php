@extends('app')
@section('title', __('common.profile'))
@include('disposable_functions')
@section('content')
  <div class="row">
    {{-- User Card --}}
      <div class="col-md-4">
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="m-0 p-1">
              {{ $user->name_private }}
              <i class="flag-icon flag-icon-{{ $user->country }} float-right"></i>
            </h5>
          </div>
          <div class="media p-1">
            @if ($user->avatar === null)
              <img src="{{ public_asset('/disposable/nophoto.jpg') }}" class="mr-1 rounded border border-dark img-h125">
            @else
              <img src="{{ $user->avatar->url }}" class="mr-1 rounded border border-dark img-h125">
            @endif  
            <div class="media-body p-0">
              @if(Auth::check() && $user->id === Auth::user()->id)
                <table class="table table-sm table-borderless">
                  <tr>
                    <td style="width: 20%">@lang('common.email')</td>
                    <td>
                      <span id="email_show" style="display: none"><i class="fas fa-eye-slash mr-1" onclick="emailHide()"></i>{{ $user->email }}</span>
                      <span id="email_hide"><i class="fas fa-eye mr-1" onclick="emailShow()"></i>@lang('disposable.showemail')</span>
                    </td>
                  </tr>
                  <tr>
                    <td>@lang('profile.apikey')</td>
                    <td>
                      <span id="apiKey_show" style="display: none"><i class="fas fa-eye-slash mr-1" onclick="apiKeyHide()"></i>{{ $user->api_key }}</span>
                      <span id="apiKey_hide"><i class="fas fa-eye mr-1" onclick="apiKeyShow()"></i>@lang('profile.apikey-show')&nbsp;(@lang('profile.dontshare'))</span>
                    </td>
                  </tr>
                  <tr>
                    <td>@lang('common.timezone')</td>
                    <td>{{ $user->timezone }}</td>
                  </tr>
                  <tr>
                    <td>@lang('profile.opt-in')</td>
                    <td>{{ $user->opt_in ? __('common.yes') : __('common.no') }}</td>
                  </tr>
                </table>
              @endif
            </div>
          </div>
          <div class="card-body p-1">
            <table class="table table-sm table-striped table-borderless text-left">
              @foreach($userFields as $field)
                @if(!$field->private && $field->value)
                  <tr>
                    <td>{{ $field->description }}</td>
                    <td class="text-right">
                      @if($field->name === 'IVAO') <a href='https://www.ivao.aero/Member.aspx?ID={{ $field->value }}' target='_blank'><b>{{ $field->value }}</b></a>
                      @elseif($field->name === 'VATSIM') <a href='https://stats.vatsim.net/search_id.php?id={{ $field->value }}' target='_blank'><b>{{ $field->value }}</b></a>
                      @else {{ $field->value }} @endif</td>
                  </tr>
                @endif
              @endforeach
            </table>
            {{-- Show Profile Action Buttons And Pill Controls --}}
            <ul class="nav nav-pills nav-justified mb-1" id="pills-tab" role="tablist">
              @if($user->awards->count() > 0)
                <li class="nav-item" role="presentation">
                  <a class="nav-link dispo-pills mr-1 ml-1 p-1" id="pills-awards-tab" data-toggle="pill" href="#pills-awards" role="tab" aria-controls="pills-awards" aria-selected="true">@lang('disposable.awards')</a>
                </li>
              @endif
              @if(isset($acars) && $acars === true && Dispo_Modules('DisposableTools'))
                <li class="nav-item" role="presentation">
                  <a class="nav-link dispo-pills mr-1 ml-1 p-1" id="pills-stats-tab" data-toggle="pill" href="#pills-stats" role="tab" aria-controls="pills-stats" aria-selected="false">@lang('disposable.exstats')</a>
                </li>
              @endif
              @if(Auth::check() && $user->id === Auth::user()->id)
                <li class="nav-item" role="presentation">
                  <a class="nav-link btn-primary mr-1 ml-1 p-1" href="{{ route('frontend.profile.edit', [$user->id]) }}">@lang('common.edit') @lang('common.profile')</a>
                </li>
                @if (isset($acars) && $acars === true)
                  <li class="nav-item" role="presentation">
                    <a class="nav-link btn-secondary mr-1 ml-1 p-1" href="{{ route('frontend.profile.acars') }}" onclick="alert('Copy or Save to \'My Documents/phpVMS\'')">@lang('disposable.acarsconfig')</a>
                  </li>
                @endif
                <li class="nav-item" role="presentation">
                  <a class="nav-link btn-danger mr-1 ml-1 p-1" href="{{ route('frontend.profile.regen_apikey') }}" onclick="return confirm('Are you sure? This will reset your API key!')">@lang('profile.newapikey')</a>
                </li>
              @endif
            </ul>
            {{-- End Profile Action Buttons --}}
          </div>
          <div class="card-footer p-1">
            <h6 class="m-0 p-1">
              {{ $user->airline->name }}<span class="float-right">{{ $user->ident }}</span>
            </h6>
          </div>
        </div>
      </div>
    {{-- End User Card --}}
    {{-- Right --}}
    <div class="col-md-8">
      <div class="row">
        {{-- First Column Group --}}
          <div class="col">
            <div class="card mb-2 text-center">
              <div class="card-body p-1">
                @if(!empty($user->rank->image_url))
                  <img src="{{ $user->rank->image_url }}" title="{{ $user->rank->name }}" class="rounded img-mh30"> 
                @else
                  <h5 class="m-1 p-0">{{ $user->rank->name }}</h5>
                @endif
              </div>
              <div class="card-footer p-1">@lang('disposable.rank')</div>
            </div>
            @if($user->home_airport)
              <div class="card mb-2 text-center">
                <div class="card-body p-1">
                  @if(Dispo_Modules('DisposableHubs'))
                    <h5 class="m-1 p-0"><a href="{{ route('DisposableHubs.hshow', [$user->home_airport->icao]) }}">{{ $user->home_airport->icao }}</a></h5>
                  @else
                    <h5 class="m-1 p-0"><a href="{{ route('frontend.airports.show', [$user->home_airport->icao]) }}">{{ $user->home_airport->icao }}</a></h5>
                  @endif
                </div>
                <div class="card-footer p-1">
                  @if(Dispo_Modules('DisposableHubs'))
                    {{ trans_choice('DisposableHubs::common.hub', 1) }}
                  @else 
                    @lang('airports.home')
                  @endif
                </div>
              </div>
            @endif
            <div class="card mb-2 text-center">
              <div class="card-body p-1">
                <h5 class="m-1 p-0">{{ $user->flights }}</h5>
              </div>
              <div class="card-footer p-1">{{ trans_choice('common.flight', 2) }}</div>
            </div>
            @if($user->last_pirep)
              <div class="card mb-2 text-center">
                <div class="card-body p-1">
                  <h5 class="m-1 p-0">{{ $user->last_pirep->submitted_at->diffForHumans() }}</h5>
                </div>
                <div class="card-footer p-1">@lang('disposable.lastflight')</div>
              </div>
            @endif
          </div>
        {{-- Second Column Group --}}
          <div class="col">
            <div class="card mb-2 text-center">
              <div class="card-body p-1">
                @if(!empty($user->airline->logo))
                  <img src="{{ $user->airline->logo }}" title="{{ $user->airline->name }}" class="rounded img-mh30"> 
                @else
                  <h5 class="m-1 p-0">{{ $user->airline->name }}</h5>
                @endif
              </div>
              <div class="card-footer p-1">@lang('common.airline')</div>
            </div>
            @if($user->current_airport)
              <div class="card mb-2 text-center">
                <div class="card-body p-1">
                  <h5 class="m-1 p-0"><a href="{{route('frontend.airports.show', [$user->current_airport->icao])}}">{{ $user->current_airport->icao }}</a></h5>
                </div>
                <div class="card-footer p-1">@lang('airports.current')</div>
              </div>
            @endif
            <div class="card mb-2 text-center">
              <div class="card-body p-1">
                <h5 class="m-1 p-0">@minutestotime($user->flight_time)</h5>
              </div>
              <div class="card-footer p-1">@lang('flights.flighthours')</div>
            </div>
            @if(setting('pilots.allow_transfer_hours') === true)
              <div class="card mb-2 text-center">
                <div class="card-body p-1">
                  <h5 class="m-1 p-0">@minutestohours($user->transfer_time)h</h5>
                </div>
                <div class="card-footer p-1">@lang('profile.transferhours')</div>
              </div>
            @endif
          </div>
        {{-- Third and Fourth Column Groups / Enabled Only If VMSAcars Module is enabled --}}
          @if(isset($acars) && $acars === true && Dispo_Modules('DisposableTools'))
            <div class="col">
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avglanding'])
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgtime'])
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgdistance'])
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgfuel'])
            </div>
            <div class="col">
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgscore'])
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'tottime'])
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totdistance'])
              @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totfuel'])
            </div>
          @endif
      </div>
    </div>
  </div>
  <div class="clearfix" style="height: 10px;"></div>
  {{-- Tabbed Contents Area --}}
  <div class="tab-content" id="pills-tabContent">
    {{-- Extended Stats / Enabled Only If VMSAcars Module is enabled --}}
      @if(isset($acars) && $acars === true && Dispo_Modules('DisposableTools'))
        <div class="tab-pane fade" id="pills-stats" role="tabpanel" aria-labelledby="pills-stats-tab">
          @include('profile.index_extendedstats')
        </div>
      @endif
    {{-- End Extended Stats --}}
    {{-- Show the user's award if they have any in a new row --}}
      @if($user->awards)
        <div class="tab-pane fade" id="pills-awards" role="tabpanel" aria-labelledby="pills-awards-tab">
          <div class="row row-cols-5">
            @foreach($user->awards as $award)
              <div class="col">
                <div class="card mb-2">
                  <div class="card-header p-1">
                    <h5 class="m-1 p-0">
                      {{ $award->name }}
                      <i class="fas fa-trophy float-right"></i>
                    </h5>
                  </div>
                  <div class="card-body text-center p-1">
                    @if($award->image_url)
                      <img src="{{ $award->image_url }}" title="{{ $award->description }}" style="max-height: 150px;">
                    @else
                      {{ $award->description }}
                    @endif
                  </div>
                  {{--}}
                    <div class="card-footer p-1">{{ $award->description }}</div>
                  {{--}}
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    {{-- End Awards --}}
  </div>
@endsection
@section('scripts')
<script>
  function apiKeyShow(){
    document.getElementById("apiKey_show").style = "display:block";
    document.getElementById("apiKey_hide").style = "display:none";
  }
  function apiKeyHide(){
    document.getElementById("apiKey_show").style = "display:none";
    document.getElementById("apiKey_hide").style = "display:block";
  }
  function emailShow(){
    document.getElementById("email_show").style = "display:block";
    document.getElementById("email_hide").style = "display:none";
  }
  function emailHide(){
    document.getElementById("email_show").style = "display:none";
    document.getElementById("email_hide").style = "display:block";
  }
</script>
@endsection
