<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      @lang('dashboard.recentreports')
      <i class="fas fa-upload float-right"></i>
    </h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-sm table-striped table-borderless mb-0 text-left">
      @foreach($pireps as $p)
        <tr>
          <th>{{ $p->airline->code }} {{ $p->flight_number }}</th>
          <td><a href="{{route('frontend.airports.show', [$p->dpt_airport_id])}}">{{$p->dpt_airport_id}}</a></td>
          <td><a href="{{route('frontend.airports.show', [$p->arr_airport_id])}}">{{$p->arr_airport_id}}</a></td>
          <td>@if(!empty($p->aircraft)) {{ optional($p->aircraft)->registration }} ({{ $p->aircraft->icao }}) @endif</td>
          <td>{{ $p->submitted_at->diffForHumans() }}</td>
          <td>{{ $p->user->name_private }}
        </tr>
      @endforeach
    </table>
  </div>
</div>
