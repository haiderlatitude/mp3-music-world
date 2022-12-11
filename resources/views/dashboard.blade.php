@extends('dashboard.app', ['title' => 'Dashboard'])

@section('body')
    {!! $dataTable->table() !!}
    <audio src="{{$filePath}}" id="audio-player" controls></audio>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
