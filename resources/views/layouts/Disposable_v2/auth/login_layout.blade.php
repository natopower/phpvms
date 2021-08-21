<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/frontend/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/disposable/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <title>@yield('title') - {{ config('app.name') }}</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
  <!-- BootStrap CDN v4.6.0 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!-- FontAwesome Latest Online -->
  <script src="https://kit.fontawesome.com/1310cf8385.js" crossorigin="anonymous"></script>
  <!-- PhpVms v7 Default Stylesheet -->
  <link href="{{ public_asset('/assets/frontend/css/styles.css') }}" rel="stylesheet"/>
  <!-- Custom Style for Disposable v1 Layout -->
  <link href="{{ public_asset('/assets/frontend/css/styles_disposable_v2.css') }}" rel="stylesheet"/>
  
  @yield('css')
</head>

<body class="login-page">
  <div class="page-header">
    <div class="container mb-5">
      @yield('content')
    </div>
    <div class="container">
      <div class="col-md-6 ml-auto mr-auto content-center">
        <div class="card text-center p-1 mb-2">
          <span>&copy; @php echo date('Y'); @endphp {{ config('app.name') }} || Powered by <a href='https://www.phpvms.net' target='_blank'><b>phpVMS v7</b></a></span>
        </div>
      </div>
    </div>   
  </div>
</body>
<script src="{{ public_asset('/assets/global/js/jquery.js') }}" type="text/javascript"></script>
@yield('scripts')
</html>
