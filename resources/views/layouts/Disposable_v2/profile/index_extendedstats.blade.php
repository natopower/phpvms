<div class="row">
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avglanding', 'period' => 7])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avglanding', 'period' => 15])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgtime', 'period' => 7])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgtime', 'period' => 15])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgdistance', 'period' => 7])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgdistance', 'period' => 15])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgfuel', 'period' => 7])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgfuel', 'period' => 15])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgscore', 'period' => 7])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avgscore', 'period' => 15])
  </div>
</div>
<hr>
{{-- Monthly Stats --}}
<div class="row">
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avglanding', 'period' => 'currentm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avglanding', 'period' => 'lastm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'avglanding', 'period' => 'prevm'])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'tottime', 'period' => 'currentm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'tottime', 'period' => 'lastm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'tottime', 'period' => 'prevm'])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totdistance', 'period' => 'currentm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totdistance', 'period' => 'lastm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totdistance', 'period' => 'prevm'])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totfuel', 'period' => 'currentm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totfuel', 'period' => 'lastm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totfuel', 'period' => 'prevm'])
  </div>
  <div class="col">
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totflight', 'period' => 'currentm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totflight', 'period' => 'lastm'])
    @widget('Modules\DisposableTools\Widgets\PersonalStats', ['disp' => 'full', 'user' => $user->id, 'type' => 'totflight', 'period' => 'prevm'])
  </div>
</div>
