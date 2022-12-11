@extends('dashboard.app', ['title' => 'Dashboard'])

@section('body')
    <div>
        {!! $dataTable->table() !!}
        <div class="relative-bottom row">
            <audio id="player" controls="controls">

                <source id="ogg_src" src="" type="audio/ogg"/>
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}

    <script>

        $.fn.playSong = function () {
            let url = $(this).data('file-path');

            console.log(url)
            let player = $('#player');
            $("#ogg_src").attr("src", 'songs/' + url);
            // console.log($("#ogg_src").attr("src", url));

            player[0].pause();
            player[0].load();
            player[0].oncanplaythrough = player[0].play();
            console.log('appent');
        }

    </script>
@endpush
