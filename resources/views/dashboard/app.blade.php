<!DOCTYPE html>
<html lang="en">

@include('dashboard.head', ['title' => "$title"])

<body>
<div class="main-wrapper">
    @include('dashboard.header')
    @include('dashboard.sidebar')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                @section('body')
                @show
            </div>
        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
@include('dashboard.js')
@section('js')
@show

@stack('scripts')
</body>

</html>
