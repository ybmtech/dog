<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Dog World') }}|{{ $title }}</title>
     <!-- Fontfaces CSS-->
     <link href="{{ asset('control_assets/css/font-face.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
 
     <!-- Bootstrap CSS-->
     <link href="{{ asset('control_assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
 
     <!-- Vendor CSS-->
     <link href="{{ asset('control_assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
     <link href="{{ asset('control_assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
  
     <!-- Main CSS-->
     <link href="{{ asset('control_assets/css/theme.css') }}" rel="stylesheet" media="all">
 
    @stack('styles')
</head>
<body class="animsition">
    <div class="page-wrapper">
     <!-- PAGE CONTAINER-->
     <div class="page-content">
        <div class="login-wrap">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                        {{ strtoupper(config('app.name', 'Dog World')) }}
                    </a>
                </div>
                <div class="login-form">
                    @yield('content')
                    @include('sweetalert::alert')     
                </div>
            </div>
        </div>
          
         <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
     </div>
  </div>
  
   <!-- Jquery JS-->
   <script src="{{ asset('control_assets/vendor/jquery-3.2.1.min.js') }}"></script>
   <!-- Bootstrap JS-->
   <script src="{{ asset('control_assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
   <script src="{{ asset('control_assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
   <!-- Vendor JS       -->
   <script src="{{ asset('control_assets/vendor/slick/slick.min.js') }}">
   </script>
   <script src="{{ asset('control_assets/vendor/wow/wow.min.js') }}"></script>
   <script src="{{ asset('control_assets/vendor/animsition/animsition.min.js') }}"></script>
   <script src="{{ asset('control_assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
   </script>
   <script src="{{ asset('control_assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
   <script src="{{ asset('control_assets/vendor/counter-up/jquery.counterup.min.js') }}">
   </script>
   <script src="{{ asset('control_assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
   <script src="{{ asset('control_assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
   <script src="{{ asset('control_assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
   <script src="{{ asset('control_assets/vendor/select2/select2.min.js') }}"></script>
   <script>
    function forceNumeric(){
      var $input = $(this);
      $input.val($input.val().replace(/[^\d]+/g,''));
  }
  $('body').on('propertychange input', '.is-number', forceNumeric);
    </script>
   <!-- Main JS-->
   <script src="{{ asset('control_assets/js/main.js') }}"></script>

  @stack('scripts')
  @stack('modal')
</body>