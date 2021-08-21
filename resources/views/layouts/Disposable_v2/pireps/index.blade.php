@extends('app')
@section('title', trans_choice('common.pirep', 2))
@include('disposable_functions')
@section('content')

  <div class="row">
    <div class="col">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">@lang('disposable.mypireps')
            <i class="fas fa-upload float-right"></i>
          </h5>
        </div>
        <div class="card-body p-0">
          @include('pireps.table')
        </div>
        <div class="card-footer text-right p-1">
          <span class="float-left m-1 p-0">
            <b>@lang('disposable.total'): {{ $pireps->total() }}</b>
          </span>
          @if(Theme::getSetting('manual_pireps'))
            <a class="btn btn-info btn-sm" href="{{ route('frontend.pireps.create') }}">@lang('pireps.filenewpirep')</a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col text-center">
      {{ $pireps->links('pagination.default') }}
    </div>
  </div>
@endsection
