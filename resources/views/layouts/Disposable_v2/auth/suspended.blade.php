@extends('app')
@section('title', __('auth.accountsuspended'))

@section('content')
<div class="col-8 ml-auto mr-auto mt-5 content-center">
  <div class="card text-center">
    <h4 class="m-1 p-1">@lang('auth.suspendedmessage')</h4>
  </div>
</div>
@endsection
