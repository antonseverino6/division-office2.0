
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- CSRF Token --> 
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>@yield('title', 'SDO Rizal')</title>


  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
    @include('partials.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
           <router-view></router-view>
           <!-- set progressbar -->
        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('js/app.js') }}"></script>


{{-- <script src="{{asset('js/jquery/jquery.min.js')}}"></script> --}}
<!-- Bootstrap 4 -->
{{-- <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script> --}}
<!-- AdminLTE App -->
{{-- <script src="{{asset('js/adminlte.min.js')}}"></script> --}}
<!-- jQuery -->

{{-- <script>
    var url = window.location;
    
    // for sidebar menu entirely but not cover treeview
    $('.nav .nav-link').filter(function() {
      return this.href == url;
    }).addClass('active');
    
</script> --}}

</body>
</html>
