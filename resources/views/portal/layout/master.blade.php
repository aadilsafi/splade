<!DOCTYPE html>

<html class="loading" lang="en">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('portal/app-assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('portal/app-assets') }}/css/trainee.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('portal/app-assets') }}/css/bsnav.min.css">
       <link rel="stylesheet" type="text/css" href="{{asset('lms/app-assets/vendors/css/extensions/sweetalert2.min.')}}css">

    <title>Home</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('page-css')
   
    <style>
    .navbar{
       padding: 0px 0px !important
    }
    </style>
    @yield('custom-css')
</head>

<body class="bg-2">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                {{ view('portal.layout.sidebar') }}
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        {{ view('portal.layout.topbar') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-body">
                            <div class="mt-5 ">
                                {{ view('lms.layout.alerts') }}
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-10 offset-lg-1 col-md-8">
                        <div class="content-body">
                            <div class="container-fluid mt-5 main-height">
                            @yield('content')
                        </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
<script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
      <script src="https://rawgit.com/fitodac/bsnav/master/dist/bsnav.min.js"></script>
    <!--BEGIN: gsap JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
    <!--END: gsap JS-->
    <script src="{{asset('lms/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>


    @yield('page-js')
    
    <script>
        $('#ach').on('show.bs.collapse', function() {
            $('#toggler').text('See less');
        })
        $('#ach').on('hide.bs.collapse', function() {
            $('#toggler').text('See more');
        })
    </script>
    @yield('custom-js')
</body>

</html>