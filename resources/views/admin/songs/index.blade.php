@extends('dashboard.app', ['title' => 'Songs List'])

@section('body')
    @if(session()->has('message'))
    <div>
        {{ session('message') }}
    </div>
    @endif

    <!-- <a href="{{ route('songs.create') }}">Upload a Song</a> -->

    {{ $dataTable->table() }}
@endsection

@section('js')
    @include('admin.songs.js')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
