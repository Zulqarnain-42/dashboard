<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Future Art Broadcast Trading') }}</title>
    @yield('styles')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" type="text/css"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" type="text/css"/>
    <script src="{{ URL::asset('assets/js/layout.js') }}"></script>
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/plugins/fakeloader/dist/fakeloader.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body>



    <div id="layout-wrapper">
        <div id="fakeloader-overlay" class="visible incoming">
            <div class="loader-wrapper-outer">
              <div class="loader-wrapper-inner">
                <div class="loader"></div>
              </div>
            </div>
          </div>
        @include('layouts.header')
        @include('layouts.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/sweetalerts.init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('assets/plugins/fakeloader/src/fakeloader.js') }}"></script>
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>
    <script src="{{ URL::asset('assets/js/plugins.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="{{ URL::asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    @yield('scripts')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
</body>

</html>
