@extends('dashboard.app', ['title' => 'All Users'])

@section('body')
    @if(session()->has('message'))
        <div class="text-center pb-3">
        {{ session('message') }}
        </div>
    @endif


    {{ $dataTable -> table()}}
@endsection

@section('usersjs')
    @include('admin.songs.usersjs')
@endsection

@push('scripts')
    {{ $dataTable -> scripts() }}
@endpush