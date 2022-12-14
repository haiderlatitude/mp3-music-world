<a type="submit"
   href="playlist/{{ $playlist->id }}"
   class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
   data-toggle="tooltip" data-placement="top" title="Edit Playlist">
    <i class="bi bi-pen"> </i>
</a>

<button type="submit"
        onclick="$(this).deletePlaylist()"
        class="btn btn-outline-danger rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Delete Playlist"
        data-id="{{ $playlist->id }}">
    <i class="bi bi-trash"> </i>
</button>

