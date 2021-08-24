<table class="table table-hover" id="users-table">
    <thead>
        <th>flight number</th>
        <th>dep</th>
        <th>arr</th>
        <th>distance</th>
        <th>bid</th>
        <th>actions</th>
    </thead>
    @foreach($flights as $flight)
        <tr>
            <td style="vertical-align: middle" >{{ $flight->ident }}</td>
            <td style="text-transform: none; vertical-align: middle">{{$flight->dpt_airport_id}} @if($flight->dpt_time), {{ $flight->dpt_time }}@endif</td>
            <td style="text-transform: none; vertical-align: middle">{{$flight->arr_airport_id}} @if($flight->arr_time), {{ $flight->arr_time }}@endif</td>
            <td style="vertical-align: middle">{{ $flight->distance }} {{ setting('units.distance') }}</td>
            <td style="vertical-align: middle">
            {{--
                !!! NOTE !!!
                Don't remove the "save_flight" class, or the x-id attribute.
                It will break the AJAX to save/delete
                "x-saved-class" is the class to add/remove if the bid exists or not
                If you change it, remember to change it in the in-array line as well
                --}}
                @if (!setting('pilots.only_flights_from_current') || $flight->dpt_airport_id == $user->current_airport->icao)
                    <button class="btn btn-round btn-icon btn-icon-mini save_flight {{ isset($saved[$flight->id]) ? 'btn-info':'' }}"
                            x-id="{{ $flight->id }}"
                            x-saved-class="btn-info"
                            type="button"
                            title="@lang('flights.addremovebid')">
                    <i class="fas fa-map-marker"></i>
                    </button>
                @endif
            </td>
            <td style="vertical-align: middle">
                @if ($acars_plugin)
                @if (isset($saved[$flight->id]))
                    <a href="vmsacars:bid/{{ $saved[$flight->id] }}" class="btn btn-sm btn-primary">Load in vmsACARS</a>
                @else
                    <a href="vmsacars:flight/{{ $flight->id }}" class="btn btn-sm btn-primary">Load in vmsACARS</a>
                @endif
                @endif
                <!-- Simbrief enabled -->
                @if ($simbrief !== false)
                <!-- If this flight has a briefing, show the link to view it-->
                @if ($flight->simbrief && $flight->simbrief->user_id === $user->id)
                    <a href="{{ route('frontend.simbrief.briefing', $flight->simbrief->id) }}" class="btn btn-sm btn-primary">View Simbrief Flight Plan</a>
                    @else
                    <!-- Show button if the bids-only is disable, or if bids-only is enabled, they've saved it -->
                    @if ($simbrief_bids === false || ($simbrief_bids === true && isset($saved[$flight->id])))
                    <a href="{{ route('frontend.simbrief.generate') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-primary">Create Simbrief Flight Plan</a>   
                    @endif            
                @endif
                @endif
                <a href="{{ route('frontend.pireps.create') }}?flight_id={{ $flight->id }}" class="btn btn-sm btn-info">file pirep</a>
            </td>
        </tr>
    @endforeach
</table>
