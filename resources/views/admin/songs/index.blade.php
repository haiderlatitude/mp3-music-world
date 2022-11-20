@extends('dashboard.app', ['title' => 'Songs List'])

@section('body')
    {{ $dataTable->table() }}
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
