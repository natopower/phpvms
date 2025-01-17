@extends('app')
@section('title', trans_choice('common.pirep', 2))

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div style="float:right;">
        <a class="btn-primary mt-0 btn-sm pull-right"
           style="margin-top: -10px;margin-bottom: 5px"
           href="{{ route('frontend.pireps.create') }}">@lang('pireps.filenewpirep')</a>
      </div>
      <h2 class="font-weight-bold">your pireps</h2>
      @include('flash::message')
      @include('pireps.table')
    </div>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      {{ $pireps->links('pagination.default') }}
    </div>
  </div>
@endsection

