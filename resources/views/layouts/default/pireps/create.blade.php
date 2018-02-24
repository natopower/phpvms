@extends("layouts.${SKIN_NAME}.app")
@section('title', 'File Flight Report')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="description">New Flight Report</h2>
            @include('flash::message')
            {!! Form::open(['route' => 'frontend.pireps.store']) !!}

            @include("layouts.${SKIN_NAME}.pireps.fields")

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@include("layouts.${SKIN_NAME}.pireps.scripts")
