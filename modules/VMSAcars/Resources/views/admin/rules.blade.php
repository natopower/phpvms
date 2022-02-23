{{ Form::model($all_rules, ['route' => ['vmsacars.admin.rules'], 'method' => 'post']) }}
<div class="card border-blue-bottom">
  <div class="content">
    <div class="header">
      <h3>Rules</h3>
      <p class="description">
        These are rules that a PIREP is rated by. There are thresholds for some rules
        and the points that are deducted from the PIREP score for a violation

        <ul>
          <li><strong>Parameter</strong> - the threshold at which this is triggered</li>
          <li><strong>Delay</strong> - Only trigger a violation after this amount of time (seconds)</li>
          <li><strong>Repeatable</strong> - If this violaton can be repeated</li>
          <li><strong>Cooldown</strong> - If repeatable, wait this time until triggering again (seconds)</li>
        </ul>
      </p>
    </div>
    <table class="table table-hover" id="flights-table">
      <thead>
      <th></th>
      <th>Threshold</th>
      <th>Points</th>
      <th>Delay</th>
      <th>Repeatable</th>
      <th>Cooldown</th>
      <th>Enabled</th>
      </thead>

      @foreach($all_rules as $rule)
        <tr>
          <td width="70%">
            <p>{{ $rule->name }}</p>
            <p class="description">
              {{ $rule->description }}
            </p>
          </td>
          <td>
            @if($rule->has_parameter)
              {{ Form::input('text', $rule->id.'_parameter', $rule->parameter, [
                  'class' => 'form-control',
                  'style' => 'width: 5em',
                ]) }}
            @endif
          </td>
          <td>
            {{ Form::number($rule->id.'_points', $rule->points, [
                'class' => 'form-control',
                'style' => 'width: 5em',
              ]) }}
          </td>
          <td>
            {{ Form::number($rule->id.'_delay', $rule->delay, [
                'class' => 'form-control', 'style' => 'width: 5em',
              ]) }}
          </td>
          <td align="center">
            {{ Form::hidden($rule->id.'_repeatable', 0)  }}
            {{ Form::checkbox($rule->id.'_repeatable', null, $rule->repeatable) }}
          </td>
          <td>
            {{ Form::number($rule->id.'_cooldown', $rule->cooldown, [
                  'class' => 'form-control',
                  'style' => 'width: 5em',
              ]) }}
          </td>
          <td align="center">
            {{ Form::hidden($rule->id.'_enabled', 0)  }}
            {{ Form::checkbox($rule->id.'_enabled', null, $rule->enabled) }}
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
