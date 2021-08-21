<table class="table table-sm table-striped table-borderless mb-0 text-left">
  @foreach($files as $file)
    <tr>
      <th><a href="{{route('frontend.downloads.download', [$file->id])}}" target="_blank">{{ $file->name }}</a></th>
      <td class="text-right">{{ $file->download_count.' '.trans_choice('common.download', $file->download_count) }}</td>
    </tr>
    @if($file->description)
      <tr>
        <td>{{ $file->description }}</td>
      </tr>
    @endif
  @endforeach
</table>
