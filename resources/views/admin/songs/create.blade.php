@extends('dashboard.app', ['title' => 'Upload Song'])

@section('body')

    @if(session()->has('message'))
        <div class="text-center pb-3">
            {{ session('message') }}
        </div>
    @endif
    <div class="card-box">
        <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-form-label col-md-2">Song Name</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="song-name" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-2">Artist</label>
                <div class="col-md-10">
                    <select class="form-control" id="artist-id" name="artist-id" required>
                        <option value="">-- Select --</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="col-form-label col-md-2 mt-3">Category</label>
                <div class="col-md-10 mt-3">
                    <select class="form-control" id="category-id" name="category-id" required>
                        <option value="">-- Select --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-md-2">File input</label>
                <div class="col-md-10">
                    <input class="form-control" type="file" name="song" id="song" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="input-group-append">
                </div>
            </div>
            <button class="btn btn-primary" type="submit" value="submit" id="submit">Upload</button>

        </form>

        <a href="{{ url('admin/clear_temp') }}" class="btn btn-danger mt-2">Delete Temporary Files</a>

@endsection

@section('js')
    @include('admin.songs.js')
@endsection
