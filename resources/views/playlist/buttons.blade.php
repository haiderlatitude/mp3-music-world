<button type="submit"
        onclick="$(this).editPlaylist()"
        class="btn btn-outline-primary rounded-circle btn-sm d-inline"
        data-toggle="tooltip" data-placement="top" title="Edit Playlist"
        data-id="{{ $playlist->id }}"
        data-name="{{ $playlist->name }}">
    <i class="bi bi-pen"> </i>
</button>

<button type="submit"
        onclick="$(this).deletePlaylist()"
        class="btn btn-outline-danger rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Delete Playlist"
        data-id="{{ $playlist->id }}">
    <i class="bi bi-trash"> </i>
</button>

<button type="submit"
        onclick=""
        class="btn btn-outline-secondary rounded-circle btn-sm d-inline"
        data-toggle="tooltip" data-placement="top" title="Open Playlist"
        data-id="{{ $playlist->id }}">
    <i class="bi bi-arrow-right"> </i>
</button>