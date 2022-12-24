<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--    <meta charset="utf-8">--}}
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @include('dashboard.head' ,  ["title" => 'Update Profile'] )
</head>
<body class="font-sans antialiased">
<body class="" id="bodypd">
<div class="main-wrapper">
    @include('dashboard.header')

    @include('dashboard.sidebar')
    <!--Container Main start-->
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-12">
                    {{--       Main body of users list page started--}}

                    <div class="card ">
                        <div class="card-header">
                            <div class="d-inline">
                                <h2 class="font-weight-bold"
                                    style="font-weight: bold; color: #009efb;">{{ 'User Profile' }}</h2>
                            </div>
                            <div>
                                @section('breadcrumbs')
                                @show
                            </div>


                            <div class="d-inline">
                                @section('title-bar-content')
                                @show
                            </div>
                        </div>


                        <div class="card-body">
                            <!-- Page Content -->
                            <main>
                                {{ $slot }}
                            </main>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <!--Container Main end-->

    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>


@stack('modals')

@livewireScripts

@include('dashboard.js')

@section('js')
@show

@stack('scripts')
</body>
</html>
