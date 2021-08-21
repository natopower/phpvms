<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      @lang('common.newestpilots')
      <i class="fas fa-users float-right"></i>
    </h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-sm table-striped table-borderless mb-0 text-left">
      @foreach($users as $u)
        <tr>
          <th>{{ $u->ident }}</th>
          <td>{{ $u->name_private }}</td>
          <td>{{ strtoupper($u->country) }}</td>
          <td>{{ $u->created_at->diffForHumans() }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
