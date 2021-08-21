<ul class="navbar-nav ml-auto d-flex align-items-center">
  {{-- Menu Items --}}
  @if(Auth::check())
    @if(Theme::getSetting('utc_clock'))
      <li class="nav-item nav-link" style="font-weight: 500;">
        <i class="fas fa-clock mr-1"></i><span id="clock"></span> UTC
      </li>
    @endif

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
          <i class="{{ $link['icon'] }}"></i>{{ ($link['title']) }}
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
      <a class="nav-link m-1 p-1" href="{{ route('frontend.pilots.index') }}">
        <i class="fas fa-users"></i>
        {{ trans_choice('common.pilot', 2) }}
      </a>
    </li>

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
  @endif

  @if(Auth::check())
    <li class="nav-item" style="margin-left: 15px; padding-left: 5px;">
      <div class="nav-link custom-control custom-switch m-1 p-1">
        <input type="checkbox" class="ml-2 custom-control-input" id="darkSwitch" name="Dark Mode"/>
        <label class="ml-2 custom-control-label" for="darkSwitch">@lang('disposable.darkmode')</label>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if (Auth::user()->avatar == null)
          <img src="{{ public_asset('/disposable/nophoto.jpg') }}" class="rounded img-mh40 border border-dark"/>
        @else
          <img src="{{ Auth::user()->avatar->url }}" class="rounded img-mh40 border border-dark">
        @endif
      </a>
      <div class="dropdown-menu bg-dropdown dropdown-menu-right">

        <a class="dropdown-item" href="{{ route('frontend.profile.index') }}">
          <i class="far fa-id-badge mr-1"></i>@lang('disposable.myprofile')
        </a>

        @if(Dispo_Modules('DisposableAirlines'))
          <a class="dropdown-item" href="{{ route('DisposableAirlines.ashow', [Auth::user()->airline->icao]) }}">
            <i class="fas fa-calendar-week mr-1"></i>@lang('disposable.myairline')
          </a>
        @endif

        @if(setting('pilots.home_hubs_only') && Dispo_Modules('DisposableHubs') && Auth::user()->home_airport_id)
          <a class="dropdown-item" href="{{ route('DisposableHubs.hshow', [Auth::user()->home_airport_id]) }}">
            <i class="fas fa-calendar-day mr-1"></i>@lang('disposable.myhub')
          </a>
        @endif

        <a class="dropdown-item" href="{{ route('frontend.pireps.index') }}">
          <i class="fas fa-file-upload mr-1"></i>@lang('disposable.mypireps')
        </a>

        @ability('admin', 'admin-access')
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ url('/admin') }}">
            <i class="fas fa-cogs mr-1"></i>@lang('common.administration')
          </a>
        @endability
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ url('/logout') }}">
          <i class="fas fa-sign-out-alt mr-1"></i>@lang('common.logout')
        </a>
      </div>
    </li>
  @endif
</ul>
