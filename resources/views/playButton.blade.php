<button type="submit"
        onclick="$(this).playSong()"
        class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Play"
        data-id="{{ $music->id }}"
        data-name="{{ $music->name }}"
        data-file-path="{{ $music->file_path }}">
    <i class="bi bi-play"> </i>
</button>

@if(auth()->check())
    <a type="button"
       class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
       data-toggle="tooltip" data-placement="top" title="Download"

       href="songs/{{ $music->file_path }}">
        <i class="bi bi-download"> </i>
    </a>
@endif

