<div class="navbar-nav mr-auto d-flex">
  @if(Auth::check())
    <li class="nav-item">
      <span class="nav-link m-1 p-0 ">
        @if (Auth::user()->avatar == null)
          <img src="{{ public_asset('/disposable/nophoto.jpg') }}" class="rounded img-mh50 border border-dark"/>
        @else
          <img src="{{ Auth::user()->avatar->url }}" class="rounded img-mh50 border border-dark">
        @endif
        {{ Auth::user()->name_private }}
      </span>
    </li>
    {{-- Icons Below User Image --}}
    <span>
      @ability('admin', 'admin-access')
        <a class="nav-link m-1 p-0 float-left" href="{{ url('/admin') }}">
          <i class="fas fa-circle-notch" title="@lang('common.administration')"></i>
        </a>
      @endability
      <a class="nav-link m-1 p-0 float-left" href="{{ route('frontend.profile.index') }}">
        <i class="far fa-id-badge" title="@lang('disposable.myprofile')"></i>
      </a>
      @if(Dispo_Modules('DisposableAirlines'))
        <a class="nav-link m-1 p-0 float-left" href="{{ route('DisposableAirlines.ashow', [Auth::user()->airline->icao]) }}">
          <i class="fas fa-calendar-week" title="@lang('disposable.myairline')"></i>
        </a>
      @endif
      @if(setting('pilots.home_hubs_only') && Dispo_Modules('DisposableHubs') && Auth::user()->home_airport_id)
        <a class="nav-link m-1 p-0 float-left" href="{{ route('DisposableHubs.hshow', [Auth::user()->home_airport_id]) }}">
          <i class="fas fa-calendar-day" title="@lang('disposable.myhub')"></i>
        </a>
      @endif
      <a class="nav-link m-1 p-0 float-left" href="{{ route('frontend.pireps.index') }}">
        <i class="fas fa-file-upload" title="@lang('disposable.mypireps')"></i>
      </a>
      <a class="nav-link m-1 ml-2 p-0 float-right" href="{{ url('/logout') }}">
        <i class="fas fa-sign-out-alt" title="@lang('common.logout')"></i>
      </a>
    </span>
    <div class="clearfix" style="height: 10px;"></div>

    {{-- Menu Items --}}
    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ route('frontend.dashboard.index') }}">
        <i class="fas fa-house-user"></i>
        @lang('common.dashboard')
      </a>
    </li>

    @if(Dispo_Modules('DisposableAirlines'))
      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableAirlines.aindex') }}">
          <i class="fas fa-calendar-alt"></i>
          @lang('DisposableAirlines::common.airlines')
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableAirlines.dfleet') }}">
          <i class="fas fa-plane"></i>
          @lang('DisposableAirlines::common.fleet')
        </a>
      </li>
    @endif

    @if(Dispo_Modules('DisposableHubs'))
      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableHubs.hindex') }}">
          <i class="fas fa-calendar-day"></i>
          {{ trans_choice('DisposableHubs::common.hub', 2) }}
        </a>
      </li>
    @endif

    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ route('frontend.pilots.index') }}">
        <i class="fas fa-users"></i>
        {{ trans_choice('common.pilot', 2) }}
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ route('frontend.flights.index') }}">
        <i class="fas fa-paper-plane"></i>
        {{ trans_choice('common.flight', 2) }}
      </a>
    </li>

    @if(Dispo_Modules('DisposableTours'))
      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableTours.dtours') }}">
          <i class="fas fa-map-signs"></i>
          @lang('DisposableTours::common.tours')
        </a>
      </li>
    @endif

    @if(Dispo_Modules('DisposableAirlines'))
      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableAirlines.dpireps') }}">
          <i class="fas fa-upload"></i>
          {{ trans_choice('common.pirep', 2) }}
        </a>
      </li>
    @endif

    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ route('frontend.livemap.index') }}">
        <i class="fas fa-globe"></i>
        @lang('common.livemap')
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ route('frontend.downloads.index') }}">
        <i class="fas fa-download"></i>
        {{ trans_choice('common.download', 2) }}
      </a>
    </li>

    @if(Dispo_Modules('DisposableRanks'))
      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableRanks.dranks') }}">
          <i class="fas fa-tags"></i>
          @lang('DisposableRanks::common.ranks')
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableRanks.dawards') }}">
          <i class="fas fa-trophy"></i>
          @lang('DisposableRanks::common.awards')
        </a>
      </li>
    @endif

    @if(Dispo_Modules('DisposableHubs'))
      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ route('DisposableHubs.dstats') }}">
          <i class="fas fa-cog"></i>
          @lang('DisposableHubs::common.stats')
        </a>
      </li>
    @endif

    {{-- Show the module links for logged in users / auth --}}
    @foreach($moduleSvc->getFrontendLinks($logged_in=true) as &$link)
      <li class="nav-item">
        <a class="nav-link m-1 p-1" href="{{ url($link['url']) }}">
          <i class="{{ $link['icon'] }}"></i>
          {{ ($link['title']) }}
        </a>
      </li>
    @endforeach
  @endif

  {{-- Show the module links that don't require login / public --}}
  @foreach($moduleSvc->getFrontendLinks($logged_in=false) as &$link)
    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ url($link['url']) }}">
        <i class="{{ $link['icon'] }}"></i>
        {{ ($link['title']) }}
      </a>
    </li>
  @endforeach

  {{-- Show page links --}}
  @foreach($page_links as $page)
    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ $page->url }}" target="{{ $page->new_window ? '_blank':'_self' }}">
        <i class="{{ $page['icon'] }}"></i>
        {{ $page['name'] }}
      </a>
    </li>
  @endforeach

  {{-- Show public links for visitors --}}
  @if(!Auth::check())
    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ route('frontend.livemap.index') }}">
        <i class="fas fa-globe"></i>
        @lang('common.livemap')
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ url('/register') }}">
        <i class="far fa-id-card"></i>
        @lang('common.register')
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link m-1 p-1" href="{{ url('/login') }}">
        <i class="fas fa-sign-in-alt"></i>
        @lang('common.login')
      </a>
    </li>
  @else
    <li class="nav-item" style="margin-left: 25px;">
      <div class="nav-link custom-control custom-switch m-1 p-1">
        <input type="checkbox" class="ml-2 custom-control-input" id="darkSwitch" name="Dark Mode"/>
        <label class="ml-2 custom-control-label" for="darkSwitch">@lang('disposable.darkmode')</label>
      </div>
    </li>
  @endif
</div>
