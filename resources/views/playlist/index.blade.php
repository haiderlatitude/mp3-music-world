@extends('dashboard.app', ['title' => 'Playlists'])

@section('body')
    @if(session()->has('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    <button class="btn btn-primary">
        + Add Playlist
    </button>
    {{ $dataTable->table() }}
@endsection

@section('js')
    @include('playlist.js')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
