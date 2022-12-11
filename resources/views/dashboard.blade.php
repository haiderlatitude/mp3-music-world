@extends('dashboard.app', ['title' => 'Dashboard'])

@section('body')
    {!! $dataTable->table() !!}
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
