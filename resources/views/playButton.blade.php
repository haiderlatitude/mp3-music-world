<button type="submit"
        onclick="$(this).playSong()"
        class="btn btn-outline-primary rounded-circle btn-sm deletebtn d-inline"
        data-toggle="tooltip" data-placement="top" title="Play"
        data-id="{{ $music->id }}"
        data-name="{{ $music->name }}"
        data-file-path="{{ $music->file_path }}">
    <i class="bi bi-play"> </i>
</button>

@auth
    @if(is_null($playlist))
        <button type="button"
                onclick="$(this).addToPlaylist()"
                class="btn btn-outline-primary rounded-circle btn-sm  d-inline"
                data-toggle="tooltip" data-placement="top" title="Add To Playlist"
                data-id="{{ $music->id }}">
            <i class="bi bi-plus"> </i>
        </button>

    @else
        <button type="button"
                onclick="$(this).removeFromPlaylist()"
                class="btn btn-outline-primary rounded-circle btn-sm  d-inline"
                data-toggle="tooltip" data-placement="top" title="Remove From Playlist"
                data-id="{{ $music->id }}"
                data-playlist="{{ $playlist }}"
        >
            <i class="bi bi-dash"> </i>
        </button>
    @endif

    <a type="button"
       class="btn btn-outline-primary rounded-circle btn-sm  d-inline"
       data-toggle="tooltip" data-placement="top" title="Download"
       href="songs/{{ $music->file_path }}" download>
        <i class="bi bi-download"> </i>
    </a>
@endauth

