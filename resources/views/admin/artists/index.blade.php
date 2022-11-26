@extends('dashboard.app', ['title' => 'All Artists'])

@section('body')
    @if(session()->has('message'))
        <div class="text-center pb-3">
            {{ session('message') }}
        </div>
    @endif

    {{ $dataTable->table() }}
@endsection

@section('js')
    @include('admin.artists.js')
@endsection

@push('scripts')
    {{ $dataTable -> scripts() }}
@endpush