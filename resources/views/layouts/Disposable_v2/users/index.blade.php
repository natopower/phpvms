@extends('app')
@section('title', trans_choice('common.pilot', 2))
@include('disposable_functions')
@section('content')
  <div class="row">
    <div class="col">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            {{ trans_choice('common.pilot', 2) }}
            <i class="fas fa-users float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          @include('users.table')
        </div>
        <div class="card-footer p-1 text-right">
          <b>@lang('disposable.onlyactive') {{ setting('pilots.auto_leave_days') }}</b>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col text-center">
      {{ $users->links('pagination.default') }}
    </div>
  </div>
@endsection
