@if(Auth::check())
  {{ Form::open(array('action' => '\Modules\JumpSeat\Http\Controllers\JumpSeatController@jstravel', 'method' => 'post')) }}
    @if(empty($dest))
        <div class="card-header"><h5 class="m-1 p-0"><i class="fas fa-ticket-alt float-right"></i>@lang('JumpSeat::jstravel.jstitle')</h5></div>
        <div class="card-body p-1">
          <select name="newloc" id="destination" class="form-group input-group select2">
            <option value="">@lang('JumpSeat::jstravel.jsdropdown')</option>
            @foreach($jairports as $destination)
              <option value="{{ $destination->id }}">{{ $destination->id }} : {{ $destination->name }} ({{ $destination->location }})</option>
            @endforeach
          </select>
        </div>
        <div class="card-footer  pt-0 mt-0 text-right">
          <button class="btn btn-sm btn-primary" type="submit">@lang('JumpSeat::jstravel.jsbutton')</button>
        </div>
      </div>
    @elseif($dest && Auth::user()->curr_airport_id != $dest)
      <button class="btn btn-sm btn-primary" type="submit">@lang('JumpSeat::jstravel.jsbutton') | {{ strtoupper($dest) }}</button>
      <input type="hidden" name="newloc" value="{{ $dest }}">
    @endif
    <input type="hidden" name="price" value="{{ $price }}">
    <input type="hidden" name="basep" value="{{ $basep }}">
    <input type="hidden" name="croute" value="{{ url()->full() }}">
  {{ Form::close() }}
@endif
