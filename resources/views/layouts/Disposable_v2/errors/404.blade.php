@extends('app')
@section('title', __('errors.404.title'))

@section('content')
  <div class="row">
    <div class="col">
      <div class="card mb-2">
        <div class="card-header p-1"><h5 class="m-1 p-0">@lang('errors.404.title')</h5></div>
        <div class="card-body p-1">{!! str_replace(':link', config('app.url'), __('errors.404.message')).'<br />' !!}</div>
        @if($exception->getMessage())
          <div class="card-footer p-1">{{ $exception->getMessage() }}</div>
        @endif
      </div>
    </div>
  </div>
@endsection
