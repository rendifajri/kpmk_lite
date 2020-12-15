
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | KPMK Lite</title>
  <link rel="shortcut icon" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/dist/img/AdminLTELogo.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/') }}css/style.css">
  @yield('content_css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav custom_navbar_left">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto custom_navbar_right">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}/user/logout" class="nav-link">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/') }}vendor/almasaeed2010/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">KPMK Lite</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <div style="background: url('{{ asset('/') }}images/user/{{Session::get('image')}}')center center/cover;height: 35px;width: 35px" class="img-circle elevation-2"></div>
        </div>
        <div class="info">
          <a href="{{ url('/') }}/user/profile/{{Session::get('id')}}" class="d-block">{{Session::get('name')}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          @if(Session::get('type') == 'Administrator')
          <li class="nav-item">
            <a href="{{ url('/') }}/backend/dashboard" class="nav-link {{ $title == 'Dashboard' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">PROGRAM</li>
          <li class="nav-item">
            <a href="{{ url('/') }}/backend/program" class="nav-link {{ $title == 'Program' ? 'active':'' }}">
              <i class="nav-icon fas fa-folder"></i>
              <p>Program</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/backend/topic" class="nav-link {{ $title == 'Topic' ? 'active':'' }}">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>Topic</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/') }}/backend/assignment" class="nav-link {{ $title == 'Assignment' ? 'active':'' }}">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>Assignment</p>
            </a>
          </li>
          <li class="nav-header">REPORT</li>
          <li class="nav-item">
            <a href="{{ url('/') }}/backend/report" class="nav-link {{ $title == 'Report' ? 'active':'' }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Report</p>
            </a>
          </li>
          <li class="nav-header">USER</li>
          <li class="nav-item">
            <a href="{{ url('/') }}/backend/user" class="nav-link {{ $title == 'User' ? 'active':'' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-header">SETTING</li>
          <li class="nav-item">
            <a href="{{ url('/') }}/backend/setting" class="nav-link {{ $title == 'Setting' ? 'active':'' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>Setting</p>
            </a>
          </li>
          @elseif(Session::get('type') == 'User')
          <li class="nav-item">
            <a href="{{ url('/') }}/dashboard" class="nav-link {{ $title == 'Dashboard' ? 'active':'' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">PROGRAM</li>
          <li class="nav-item">
            <a href="{{ url('/') }}/program" class="nav-link {{ $title == 'Program' ? 'active':'' }}">
              <i class="nav-icon fas fa-folder"></i>
              <p>Program</p>
            </a>
          </li>
          <li class="nav-header">USER</li>
          <li class="nav-item">
            <a href="{{ url('/') }}/user" class="nav-link {{ $title == 'User' ? 'active':'' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>User</p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              @if($__env->yieldContent('sub_title') == null)
                <li class="breadcrumb-item active">@yield('title')</li>
              @elseif($__env->yieldContent('sub_sub_title') == null )
                <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
                <li class="breadcrumb-item active">@yield('sub_title')</li>
              @elseif ($__env->yieldContent('sub_sub_title') != null)
                <li class="breadcrumb-item"><a href="#">@yield('title')</a></li>
                <li class="breadcrumb-item"><a href="#">@yield('sub_title')</a></li>
                <li class="breadcrumb-item active">@yield('sub_sub_title')</li>
              @endif
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	@yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-sm">
    <strong>Copyright &copy; 2020 <a>KPMK Lite</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  	<!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/') }}js/script.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/dist/js/adminlte.js"></script>
@yield('content_js')
</body>
</html>