@extends('dashboard.app', ['title' => 'Dashboard'])

@section('body')
    <div>
        {!! $dataTable->table() !!}
        <div class="relative-bottom row">
            <audio id="player" controls="controls">
                <source id="source" src="" type="audio/mpeg"/>
            </audio>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}

    <script>

        $.fn.playSong = function () {
            let url = $(this).data('file-path');
            let player = $('#player');
            $("#source").attr("src", 'songs/' + url);

            player[0].pause();
            player[0].load();
            player[0].oncanplaythrough = player[0].play();
        }

    </script>
@endpush
