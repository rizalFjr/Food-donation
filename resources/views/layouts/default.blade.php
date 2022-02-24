<!DOCTYPE html>
<html lang="en">
<head>
@include('partials.head')
@stack('head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/MakananKitaLogo.png') }}" alt="Makanan Kita Logo" height="60" width="60">
  </div>

  <!-- SweetAlert -->
  @include('sweetalert::alert')

  <!-- Navbar -->
  @include('partials.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  {{-- footer --}}
  @include('partials.footer')

  {{-- Image Modal --}}
  @include('partials.modal')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

{{-- script --}}
@include('partials.script')
@stack('js')
</body>
</html>
