<!DOCTYPE html>
<html lang="en">
@include('dashboard.includes.head')
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  @include('dashboard.includes.preloader')

  <!-- Navbar -->
  @include('dashboard.includes.navbar')

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('dashboard.includes.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->

        <!-- Main row -->
       @yield('work_space')
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('dashboard.includes.footer')

</div>
<!-- ./wrapper -->

@include('dashboard.includes.script')
@yield('js_space')

</body>
</html>
