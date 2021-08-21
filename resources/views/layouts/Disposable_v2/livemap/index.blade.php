@extends('app')
@section('title', __('common.livemap'))
@include('disposable_functions')
@section('content')
  {{ Widget::liveMap() }}
@endsection

