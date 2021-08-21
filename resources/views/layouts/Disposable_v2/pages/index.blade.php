@extends('app')
@section('title', $page->name)

@section('content')
  <div class="row">
    <div class="col">
      <div class="card mb-2">
        <div class="card-header p-1">
          <h5 class="m-1 p-0">
            <i class="fas fa-file-alt float-right"></i>
            {{ $page->name }}
          </h5>
        </div>
        <div class="card-body p-1">
          {!! $page->body !!}
        </div>
        <div class="card-footer p-1 text-right">
          @lang('disposable.lastupdate') : {{ $page->updated_at->format('l d.M.Y H:i') }}
        </div>
      </div>      
    </div>
  </div>
@endsection
