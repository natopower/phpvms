<div class="sidebar" data-background-color="white" data-active-color="info">

  <!--
      Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
      Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
  -->


  <div class="sidebar-wrapper">
    <div class="logo" style="background: #272727; margin: 0px; text-align: center; min-height: 75px;">
      <a href="{{ url('/dashboard') }}">
        <img src="{{ public_asset('/assets/img/wordmarkgreen.png') }}" width="70%" style="padding-right: 7%; padding-top: 3%">
      </a>
    </div>

    <ul class="nav">
      @include('admin.menu')
    </ul>

    <br/>

    <div class="row" style="margin-bottom: 20px;">
      <div class="col-xs-12 text-center">
        <a class="small"
           style="cursor: pointer"
           data-container="body"
           data-toggle="popover"
           data-placement="right"
           data-content="{{$version_full}}">
          version {{ $version }}
        </a>
      </div>
    </div>
  </div>
</div>
