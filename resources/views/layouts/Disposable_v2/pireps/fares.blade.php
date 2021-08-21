@if($aircraft)
  <div class="card mb-2">
    <div class="card-header p-1">
      <h5 class="m-1 p-0">
        {{ trans_choice('pireps.fare', 2) }}
        <i class="fas fa-ellipsis-h float-right"></i>
      </h5>
    </div>
    <div class="card-body p-1">
      <div class="row row-cols-3">
        @foreach($aircraft->subfleet->fares as $fare)
          <div class="col">
            {{Form::label('fare_'.$fare->id, $fare->name.' ('. \App\Models\Enums\FareType::label($fare->type).', code '.$fare->code.')')}}
            {{ Form::number('fare_'.$fare->id, null, ['class' => 'form-control form-control-sm', 'min' => 0]) }}
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
