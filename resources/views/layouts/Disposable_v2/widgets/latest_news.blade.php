<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      @lang('widgets.latestnews.news')
      <i class="fas fa-newspaper float-right"></i>
    </h5>
  </div>
  <div class="card-body p-1">
    @if($news->count() === 0)
      <div class="text-center text-muted">@lang('widgets.latestnews.nonewsfound')</div>
    @endif
    @foreach($news as $item)
      @if(!$loop->first) <hr class="m-1 p-1"> @endif
      <div class="row">
        <div class="col">
          <h6 class="mt-1 mb-1">{{ $item->subject }}</h6>
        </div>
      </div>
      <div class="row">
        <div class="col">
          {!! $item->body !!}
        </div>
      </div>
      <div class="row">
        <div class="col text-right">
          <span>{{ $item->user->name_private }} @ {{ $item->created_at->format('l d.M.Y H.i') }}</span>
        </div>
      </div>
    @endforeach
  </div>
</div>
