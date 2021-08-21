<div id="flash-overlay-modal" class="modal fade {{ isset($modalClass) ? $modalClass : '' }}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header p-1">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h5 class="modal-title m-1 p-0">{{ $title }}</h5>
      </div>
      <div class="modal-body p-1">
        <p>{!! $body !!}</p>
      </div>
      <div class="modal-footer p-1">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('disposable.close')</button>
      </div>
    </div>
  </div>
</div>
