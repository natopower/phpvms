<div class="nav nav-tabs" role="tablist" style="background: #8C0AC8; color: #FFF;">
  @lang('widgets.latestnews.news')
</div>
<div class="card border-blue-bottom">
  <div class="card-body" style="min-height: 0px">
    @if($news->count() === 0)
      <div class="text-center text-muted" style="padding: 30px;">
        no news to share!
      </div>
    @endif

    @foreach($news as $item)
      <h4 class="font-weight-bold" style="margin-top: 0px;">{{ $item->subject }}</h4>
      <p>{{ $item->user->name_private }}
        - {{ show_datetime($item->created_at) }}</p>

      {!! $item->body !!}
    @endforeach
  </div>
</div>
