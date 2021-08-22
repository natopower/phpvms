{{--

If you want to edit this, you can reference the CheckWX API docs:
https://api.checkwx.com/#metar-decoded

--}}
<table class="table table-striped">
  @if($config['raw_only'] != true && $metar)
    <tr>
      <td>@lang('widgets.weather.conditions')</td>
      <td style="text-transform: uppercase" !important>{{ $metar['category'] }}</td>
    </tr>
    <tr>
      <td>@lang('widgets.weather.wind')</td>
      <td style="text-transform: none" !important>
        @if($metar['wind_speed'] < '3') Calm @else {{ $metar['wind_speed'] }} kts @lang('common.from') {{ $metar['wind_direction_label'] }} ({{ $metar['wind_direction']}}°) @endif
				@if($metar['wind_gust_speed']) @lang('widgets.weather.guststo') {{ $metar['wind_gust_speed'] }} @endif
      </td>
    </tr>
    @if($metar['visibility'])
     <tr>
       <td>Visibility</td>
       <td style="text-transform: none" !important>{{ $metar['visibility'][$unit_dist] }} {{$unit_dist}}</td>
     </tr>
    @endif
    @if($metar['runways_visual_range'])
		 <tr>
			<td>Runway Visual Range</td>
			<td style="text-transform: none">
			  @foreach($metar['runways_visual_range'] as $rvr)
			    <b>RWY{{ $rvr['runway'] }}</b>; {{ $rvr['report'] }}<br>
			  @endforeach
			</td>
		 </tr>
		@endif
    @if($metar['present_weather_report'] <> 'Dry')
		 <tr>
			<td>Phenomena</td>
			<td style="text-transform: none">{{ $metar['present_weather_report'] }}</td>
		 </tr>
		@endif
    @if($metar['clouds'] || $metar['cavok'])
		 <tr>
			<td>@lang('widgets.weather.clouds')</td>
			<td>
				@if($unit_alt === 'ft') {{ $metar['clouds_report_ft'] }} @else {{ $metar['clouds_report'] }} @endif 
				@if($metar['cavok'] == 1) Ceiling and Visibility OK @endif
			</td>
		 </tr>
		@endif
    <tr>
			<td>Temperature</td>
			<td>
        @if($metar['temperature'][$unit_temp]) {{ $metar['temperature'][$unit_temp] }} @else 0 @endif °{{strtoupper($unit_temp)}}
				@if($metar['dew_point']), @lang('widgets.weather.dewpoint') @if($metar['dew_point'][$unit_temp]) {{ $metar['dew_point'][$unit_temp] }} @else 0 @endif °{{strtoupper($unit_temp)}} @endif 
				@if($metar['humidity']), @lang('widgets.weather.humidity') {{ $metar['humidity'] }}%  @endif
			</td>
		</tr>
    <tr>
      <td>@lang('widgets.weather.barometer')</td>
      <td style="text-transform: none">{{ number_format($metar['barometer']['inHg'], 2) }} inHg</td>
    </tr>
    @if($metar['recent_weather_report'])
		 <tr>
			<td>Recent Phenomena</td>
			<td style="text-transform: none">{{ $metar['recent_weather_report'] }}</td>
		 </tr>
		@endif
		@if($metar['runways_report'])
		 <tr>
			<td>Runway Condition</td>
			<td style="text-transform: none">
			  @foreach($metar['runways_report'] as $runway)
			    <b>RWY{{ $runway['runway'] }}</b>; {{ $runway['report'] }}<br>
			  @endforeach
			</td>
		 </tr>	
		@endif
    @if($metar['remarks'])
      <tr>
        <td>@lang('widgets.weather.remarks')</td>
        <td style="text-transform: none">{{ $metar['remarks'] }}</td>
      </tr>
    @endif
    <tr>
      <td>@lang('widgets.weather.updated')</td>
      <td style="text-transform: none">{{$metar['observed_time']}} ({{$metar['observed_age']}})</td>
    </tr>
  @endif
    <tr>
      <td>@lang('common.metar')</td>
      <td style="text-transform: uppercase">@if($metar) {{ $metar['raw'] }} @else @lang('widgets.weather.nometar') @endif</td>
    </tr>

</table>
