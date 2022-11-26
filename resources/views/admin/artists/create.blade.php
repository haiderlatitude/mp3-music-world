@extends('dashboard.app', ['title' => 'Add Artist'])

@section('body')
    @if(session()->has('message'))
    <div class="text-center">
        {{ session('message') }}
    </div>
    @endif
    
    <div class="card-box">
        <form action="{{ route('artists.store') }}" method="post">
        @csrf
            <div class="form-group row">
                <label class="col-form-label col-md-2">Artist Name</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="artist-name" required>
                </div>
            </div>
            <button class="btn btn-primary" type="submit" value="submit" id="submit">Save</button>
        </form>
    </div>

@endsection

@section('js')
    @include('admin.songs.js')
@endsection