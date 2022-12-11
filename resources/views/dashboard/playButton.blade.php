<button type="submit"
        onclick="$(this).playSong()"
        class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Play"
        data-id="{{ $music->id }}"
        data-name="{{ $music->name }}"
        data-filePath="{{ $music->file_path }}">
    <i class="bi bi-play"> </i>
</button>
