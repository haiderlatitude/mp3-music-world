<button type="submit"
        onclick="$(this).editSong()"
        class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Edit Song"
        data-id="{{ $music->id }}"
        data-name="{{ $music->name }}"
        data-artist-id="{{ $music->artist_id }}">
    <i class="bi bi-pen"> </i>
</button>

<button type="submit"
        onclick="$(this).deleteSong()"
        class="btn btn-outline-danger rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Delete Song"
        data-id="{{ $music->id }}">
    <i class="bi bi-trash"> </i>
</button>

