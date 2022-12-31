@extends('dashboard.app', ['title' => 'Categories'])

@section('body')
    @if(session()->has('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    <div>
        <button onclick="$(this).addCategory()" class="btn btn-primary mb-5">
            + Add Category
        </button>
    </div>

    {{ $dataTable->table() }}
@endsection

@section('js')
    @include('admin.category.js')
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
