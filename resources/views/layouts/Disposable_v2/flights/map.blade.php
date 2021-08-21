<div class="card box-body mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      @lang('disposable.routemap')
      <i class="fas fa-route float-right"></i>
    </h5>
  </div>
  <div class="card-body p-0">
    <div id="map" style="width: 100%; height: 600px"></div>
  </div>
</div>

@section('scripts')
  <script type="text/javascript">
    phpvms.map.render_route_map({
      route_points: {!! json_encode($map_features['route_points']) !!},
      planned_route_line: {!! json_encode($map_features['planned_route_line']) !!},
      metar_wms: {!! json_encode(config('map.metar_wms')) !!},
      leafletOptions: { 
        // scrollWheelZoom: true, 
        providers: {'OpenStreetMap.Mapnik': {},}
      }
    });
  </script>
@endsection
