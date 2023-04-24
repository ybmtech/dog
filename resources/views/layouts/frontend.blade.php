<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Dog World') }}|{{ $title }}</title>
       <!-- Favicon -->
       <link href="{{ asset('web_assets/img/favicon.ico') }}" rel="icon">

       <!-- Google Web Fonts -->
       <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 
   
       <!-- Font Awesome -->
       <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
   
       <!-- Flaticon Font -->
       <link href="{{ asset('web_assets/lib/flaticon/font/flaticon.css') }}" rel="stylesheet">
   
       <!-- Libraries Stylesheet -->
       <link href="{{ asset('web_assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
       <link href="{{ asset('web_assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
   
       <!-- Customized Bootstrap Stylesheet -->
       <link href="{{ asset('web_assets/css/style.css')}}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @include('partials.frontend.topbar')
    @include('partials.frontend.navbar')
    @yield('content')
    @include('sweetalert::alert')
  @stack('modal')
  <!-- /.content-wrapper -->
  @include('partials.frontend.footer')
  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('web_assets/lib/easing/easing.min.js')}}"></script>
  <script src="{{ asset('web_assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('web_assets/lib/tempusdominus/js/moment.min.js')}}"></script>
  <script src="{{ asset('web_assets/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
  <script src="{{ asset('web_assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>


  <!-- Template Javascript -->
  <script src="{{ asset('web_assets/js/main.js')}}"></script>
  @stack('scripts')
</body>