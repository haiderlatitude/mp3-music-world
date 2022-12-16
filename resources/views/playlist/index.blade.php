@extends('dashboard.app', ['title' => 'Playlists'])

@section('body')
    @if(session()->has('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    <div>
        <button onclick="$(this).addPlaylist()" class="btn btn-primary mb-5">
            + Add Playlist
        </button>
    </div>

    {{ $dataTable->table() }}
@endsection

@section('js')
    @include('playlist.js')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
