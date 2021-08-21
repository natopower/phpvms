<div id="map" style="border-radius: 5px; width: {{ $config['width'] }}; height: {{ $config['height'] }}"></div>

@section('scripts')
  <script>
    phpvms.map.render_airspace_map({
      lat: "{{$config['lat']}}",
      lon: "{{$config['lon']}}",
      zoom: 13,
      metar_wms: {!! json_encode(config('map.metar_wms')) !!},
      leafletOptions: {
          // scrollWheelZoom: true,
          providers: {'OpenStreetMap.Mapnik': {},}
        }
    });
  </script>
@endsection
