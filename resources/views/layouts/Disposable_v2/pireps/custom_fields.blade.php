<tr>
  <td>
    {{ $field->name }} @if($field->required === true)<span class="text-danger">*</span>@endif
  </td>
  <td>
    <div class="input-group input-group-sm form-group mb-1">
      @if(!$field->read_only)
        {{ Form::text($field->slug, $field->value, [
            'class' => 'form-control',
            'readonly' => (!empty($pirep) && $pirep->read_only),
          ]) }}
      @else
        {{ $field->value }}
      @endif
    </div>
    <p class="text-danger m-1 p-0">{{ $errors->first('field_'.$field->slug) }}</p>
  </td>
</tr>
