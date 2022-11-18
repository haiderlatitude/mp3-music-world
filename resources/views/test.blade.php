@extends('dashboard.app', ['title' => 'Page'])

@section('js')
    <script>
        $(document).on('ready', function () {
            $('h1').replaceWith('Appended');
        });
    </script>
@endsection

@section('body')
    ajknkasd sksn
    <h1>Test Page</h1>
@endsection

