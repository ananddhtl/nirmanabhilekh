
<!DOCTYPE html>
<html lang="en">
@include('frontend.include.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- <body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper"> -->


    <!-- Navbar -->
    @include('frontend.include.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('frontend.include.bottomheader')


    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      @yield('content')
    </div>




    <!-- /.content-wrapper -->
    @include('frontend.include.footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('Adminpanel/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{asset('Adminpanel/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('Adminpanel/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->

  <!-- Page specific script -->
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
  <script src="{{ asset('site/js/jquery.js') }}"></script>
  <script src="{{ asset('site/js/app.js') }}"></script>

  <script src="{{ asset('site/bootstrap/js/bootstrap.js') }}"></script>
  <script src="{{ asset('site/fontawesome/js/all.js') }}"></script>
  <script src="{{ asset('site/js/script.js') }}"></script>

  <script>
    $('#modelId').modal('show');
  </script>


</body>

</html>