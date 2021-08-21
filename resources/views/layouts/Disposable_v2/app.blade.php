<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>

    <title>@yield('title') - {{ config('app.name') }}</title>

    {{-- Start of required lines block. DON'T REMOVE THESE LINES! They're required or might break things --}}
      <meta name="base-url" content="{!! url('') !!}">
      <meta name="api-key" content="{!! Auth::check() ? Auth::user()->api_key: '' !!}">
      <meta name="csrf-token" content="{!! csrf_token() !!}">
    {{-- End the required lines block --}}

    <link rel="shortcut icon" type="image/png" href="{{ public_asset('/disposable/favicon.png') }}"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <!-- BootStrap CDN v4.6.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- FontAwesome Latest Online -->
    <script src="https://kit.fontawesome.com/1310cf8385.js" crossorigin="anonymous"></script>
    <!-- PhpVms v7 Default Stylesheet -->
    <link href="{{ public_asset('/assets/frontend/css/styles.css') }}" rel="stylesheet"/>
    <!-- Custom Style for Disposable v1 Layout -->
    <link href="{{ public_asset('/assets/frontend/css/styles_disposable_v2.css') }}" rel="stylesheet"/>
    <link href="{{ public_asset('/assets/frontend/css/styles_disposable_v2_darkmode.css') }}" rel="stylesheet"/>

    {{-- Start of the required files in the head block --}}
      <link href="{{ public_mix('/assets/global/css/vendor.css') }}" rel="stylesheet"/>
      <style type="text/css"> @yield('css') </style>
      <script> @yield('scripts_head') </script>
    {{-- End of the required stuff in the head block --}}
  </head>
  @include('disposable_functions')
  <body>
    @if(Theme::getSetting('sidebar'))
      <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
          <div id="sidebar-wrapper" class="navbar-dark bg-sidebar">
            <div class="sidebar-heading">
              <a class="navbar-brand float-left p-0 mb-2" href="{{ url('/') }}"><img class="img-h40" src="{{ public_asset('/disposable/phpvms_logo.svg') }}"/></a>
            </div>
            <div class="list-group list-group-flush">
              @include('nav_side')
            </div>
          </div>
        <!-- /#sidebar-wrapper -->
        <div id="page-content-wrapper">
          <div id="page-container">
            <!-- Top Navbar -->
            <div class="bg-transparent text-right ml-2 mr-2 mt-0 pt-1" style="font-weight: 500;">
              <i id="menu-toggle" class="fas fa-angle-double-left text-dark float-left" title="Toggle Menu"></i>
              @if(Theme::getSetting('utc_clock'))
                <span id="clock"></span> UTC<i class="fas fa-clock ml-1 mr-2"></i>
              @endif
            </div>
            <!-- End Top Navbar -->
    @else
      <div id="page-container">
      <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-navbar">
          <a class="navbar-brand float-right p-0 m-0" href="{{ url('/') }}"><img class="img-h40" src="{{ public_asset('/disposable/phpvms_logo.svg') }}"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
              aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
            </button>
          <div class="collapse navbar-collapse" id="navigation">
            @include('nav_top')
          </div>
        </nav>
      <!-- End Navbar -->
    @endif

          <div id="top_anchor" class="clearfix" style="height: 15px;"></div>

          <div class="wrapper">
            <div id="page-contents" class="container-fluid">
              {{-- These should go where you want your content to show up --}}
                @include('flash.message')
                @yield('content')
              {{-- End the above block--}}
              <div class="clearfix" style="height: 10px;"></div>
            </div>
          </div>

          {{-- Please keep the copyright message somewhere, as-per the LICENSE file Thanks!! --}}
          {{-- This applies to both PhpVms Licence and Disposable Theme Licence --}}
            <div id="footer" class="container-fluid">
              <div class="row">
                <div class="col">
                  <div class="card mt-1 mb-1">
                    <div class="card-body p-1 text-center">
                      <span class="float-left">&copy; @php echo date('Y'); @endphp {{ config('app.name') }}</span>
                      @include('theme_version')
                      <span class="float-right">Powered by <a href="http://www.phpvms.net" target="_blank">PhpVMS v7</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          {{-- Start of the required tags block. Don't remove these or things will break!! --}}
            <script src="{{ public_mix('/assets/global/js/vendor.js') }}"></script>
            <script src="{{ public_mix('/assets/frontend/js/vendor.js') }}"></script>
            <script src="{{ public_mix('/assets/frontend/js/app.js') }}"></script>
            @yield('scripts')

            {{-- EU Cookie Law Requirement https://privacypolicies.com/blog/eu-cookie-law --}}
              <script>
                window.addEventListener("load", function () {
                window.cookieconsent.initialise({palette: {popup: {background: "#edeff5",text: "#838391"},button: {"background": "#067ec1"}}, position: "top",})});
              </script>
          {{-- End the required tags block --}}
          <script src="{{ public_asset('/disposable/dark-mode-switch.min.js') }}"></script>
          <script>$(document).ready(function () {$(".select2").select2({width: 'resolve'});});</script>

          {{--
            Google Analytics tracking code. Only active if an ID has been entered
            You can modify to any tracking code and re-use that settings field, or
            just remove it completely. Only added as a convenience factor
          --}}
          @php $gtag = setting('general.google_analytics_id'); @endphp
          @if($gtag)
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtag }}"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', '{{ $gtag }}');
            </script>
          @endif
          {{-- End of the Google Analytics code --}}
    @if(Theme::getSetting('sidebar'))
          </div>
        </div>
        <!-- /#page-content-wrapper -->
      </div>
      <!-- SideBar Menu Toggle Script -->
      <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
      </script>
    @endif
    @if(Theme::getSetting('utc_clock'))
      <!-- UTC Clock -->
      <script type="text/javascript">
        var timeInterval = setInterval(display_ct, 500);
        function display_ct() {
          var x = new Date();
          var x1 = ("0" + x.getUTCHours()).slice(-2) + ":" +  ("0" + x.getUTCMinutes()).slice(-2) + ":" +  ("0" + x.getUTCSeconds()).slice(-2);
          document.getElementById('clock').innerHTML = x1;
        }
      </script>
    @endif
  </body>
</html>
