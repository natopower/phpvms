@extends('vmsacars::layouts.admin')

@section('title', 'VMS ACARS Configuration')
@section('actions')
    {{--<li>
        <a href="{{ url('/vmsacars/admin/create') }}">
            <i class="ti-plus"></i>
            Add New</a>
    </li>--}}
@endsection
@section('content')
    @include('vmsacars::admin.config')
    @include('vmsacars::admin.rules')
@endsection
