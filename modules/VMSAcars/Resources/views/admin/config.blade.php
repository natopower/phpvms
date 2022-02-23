{{ Form::model($all_rules, ['route' => ['vmsacars.admin.config'], 'method' => 'post']) }}
<div class="card border-blue-bottom">
  <div class="content">
    <div class="header">
      <h3>Config</h3>
      <p class="description">
        Configuration for ACARS
      </p>
    </div>
    <table class="table table-hover" id="flights-table">
      @foreach($all_config as $config)
        <tr>
          <td width="70%">
            <p>{{ $config->name }}</p>
            <p class="description">
              @if ($config->description)
                @component('admin.components.info')
                  {{$config->description}} 
                  @if (!empty($config->default))
                    <i>(default {{$config->default}})</i>
                  @endif
                @endcomponent
              @endif
            </p></td>
          <td align="center">
            @if($config->type === 'boolean' || $config->type === 'bool')
              {{ Form::hidden($config->id, 0)  }}
              {{ Form::checkbox($config->id, null, $config->value) }}
            @elseif($config->type === 'int')
              {{ Form::number($config->id, $config->value, ['class'=>'form-control']) }}
            @elseif($config->type === 'number')
              {{ Form::number($config->id, $config->value, ['class'=>'form-control', 'step' => '0.01']) }}
            @elseif($config->type === 'select')
                {{ Form::select(
                       $config->id,
                       list_to_assoc(explode(',', $config->options)),
                       $config->value,
                       ['class' => 'select2', 'style' => 'width: 100%; text-align: left;']) }}
            @else
              {{ Form::input('text', $config->id, $config->value, ['class' => 'form-control']) }}
            @endif
          </td>
        </tr>
      @endforeach
    </table>
  </div>
  <div class="content">
    <div class="text-right">
      {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-success']) }}
      {{--<a href="{{ route('admin.subfleets.index') }}" class="btn btn-default">Cancel</a>--}}
    </div>
  </div>
</div>
{{ Form::close() }}
