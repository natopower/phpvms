@extends('app')
@section('title', __('auth.registrationpending'))

@section('content')
  <div class="row">
    <div class="col-md-12 " style="text-align: center;">
      <div class="flex-center position-ref full-height">
        <div class="title m-b-md">
          <h4 class="description">@lang('auth.pendingmessage')</h4>
        </div>
      </div>
    </div>
  </div>
@endsection()
