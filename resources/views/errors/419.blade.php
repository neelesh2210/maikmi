<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Page Expired</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin_css/assets/vendors/core/core.css')}}">

    <link rel="stylesheet" href="{{asset('admin_css/assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('admin_css/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin_css/assets/css/demo1/style.min.css')}}">


    @if(websiteSetupValue('favicon'))
        <link rel="shortcut icon" href="{{asset('admin_css/admin/website_setup/'.websiteSetupValue('favicon'))}}" />
    @else
        <link rel="shortcut icon" href="{{asset('admin_css/assets/images/favicon.png')}}" />
    @endif
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                        <img src="https://www.nobleui.com/html/template/assets/images/others/404.svg"
                            class="img-fluid mb-2" alt="404">
                        <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">419</h1>
                        <h4 class="mb-2">Page Expired</h4>
                        <h6 class="text-muted mb-3 text-center">Oopps!! The Page has expired due to inactivity. Please refresh and try again.</h6>
                        <a href="{{ url()->previous() }}">Back to home</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{asset('admin_css/assets/vendors/core/core.js')}}"></script>

    <script src="{{asset('admin_css/assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('admin_css/assets/js/template.js')}}"></script>

</body>

</html>

{{-- @extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired')) --}}
