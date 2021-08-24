<table>
  @foreach($pireps as $p)
    <tr>
      <td style="padding-right: 10px;">
        <span style="text-transform: none" class="title">{{ $p->airline->code }}{{ $p->flight_number }}</span>
      </td>
      <td>
        <a style="text-transform: none" href="{{route('frontend.airports.show', [$p->dpt_airport_id])}}">{{$p->dpt_airport_id}}</a>
        &nbsp;-&nbsp;
        <a style="text-transform: none" href="{{route('frontend.airports.show', [$p->arr_airport_id])}}">{{$p->arr_airport_id}}</a>&nbsp;
        @if(!empty($p->aircraft))
          <text style="text-transform: none">{{ optional($p->aircraft)->registration }} ({{ $p->aircraft->icao }})
</text>@endif
      </td>
    </tr>
  @endforeach
</table>
