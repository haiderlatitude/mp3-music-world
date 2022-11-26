@extends('dashboard.app', ['title' => 'All Songs'])

@section('body')
    @if(session()->has('message'))
    <div>
        {{ session('message') }}
    </div>
    @endif

    {{ $dataTable->table() }}
@endsection

@section('js')
    @include('admin.songs.js')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
