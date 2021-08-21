@extends('app')
@section('title', __('pireps.fileflightreport'))
@include('disposable_functions')
@section('content')
  <div class="row">
    <div class="col text-left">
      <h3 class="card-title">@lang('pireps.newflightreport')</h3>
    </div>
  </div>
  @include('flash::message')

  <div class="row">
    <div class="col">
      <div class="card bg-transparent border-0 shadow-none mb-2">
        <div class="card-body p-1">
          @if(!empty($pirep))
            {{ Form::model($pirep, ['route' => 'frontend.pireps.store']) }}
          @else
            {{ Form::open(['route' => 'frontend.pireps.store']) }}
          @endif

          @include('pireps.fields')

          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection
@include('pireps.scripts')
