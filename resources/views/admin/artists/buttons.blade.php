<button type="submit"
        onclick="$(this).editArtist()"
        class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Edit Artist"
        data-id="{{ $artist->id }}"
        data-name="{{ $artist->name }}">
    <i class="bi bi-pen"> </i>
</button>

<button type="submit"
        onclick="$(this).deleteArtist()"
        class="btn btn-outline-danger rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Delete Artist"
        data-id="{{ $artist->id }}">
    <i class="bi bi-trash"> </i>
</button>

