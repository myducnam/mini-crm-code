<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="none">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') . ' Admin' }}</title>

  <!-- Styles -->
  <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    @auth('admin')
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <small class="text-secondary">Hi {{ Auth::user()->name }},</small>
          <a class="btn btn-link js-button-logout" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
            {{ __('common.logout') }}
          </a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" data-is-sidebar-animtion="false">
      <!-- Brand Logo -->
      <a href="{{ route('admin.home') }}" class="brand-link px-4">
        <span class="brand-text font-weight-light">{{ __('admin_layout.Mini CRM Admin') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            @amenu(['route' => route('admin.company.index')])
              {{ __('admin_layout.Company') }}
            @endamenu
            @amenu(['route' => route('admin.employe.index')])
              {{ __('admin_layout.Employe') }}
            @endamenu
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    @endauth
    <!-- /.main-sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="@auth('admin') @else ml-0 @endauth content-wrapper bg-alto-0">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer @auth('admin') @else ml-0 text-center @endauth">
      <strong>Copyright @ 2023 Mini CRM.</strong>
    </footer>
    <!-- /.main-footer -->
  </div>

  <!-- Toast Success -->
  @if (session('success'))
    <div class="toast -success js-toast" aria-live="assertive" aria-atomic="true" data-delay="5000"
      data-animation="true">
      <div class="toast-body">
        {{ session('success') }}
      </div>
    </div>
  @endif

  @isset($success)
    <div class="toast -success js-toast" aria-live="assertive" aria-atomic="true" data-delay="5000"
      data-animation="true">
      <div class="toast-body">
        {{ $success }}
      </div>
    </div>
  @endisset

  <div class="toast -success js-ajax-toast-success" aria-live="assertive" aria-atomic="true"
    data-delay="5000" data-animation="true">
    <div class="toast-body">
    </div>
  </div>

  <!-- Toast Alert -->
  @if (session('alert'))
    <div class="toast -alert js-toast" role="alert" aria-live="assertive" aria-atomic="true"
      data-delay="5000" data-animation="true">
      <div class="toast-body">
        {{ session('alert') }}
      </div>
    </div>
  @endif

  @isset($alert)
    <div class="toast -alert js-toast" aria-live="assertive" aria-atomic="true" data-delay="5000"
      data-animation="true">
      <div class="toast-body">
        {{ $alert }}
      </div>
    </div>
  @endisset

  <div class="toast -alert js-ajax-toast-alert" role="alert" aria-live="assertive"
    aria-atomic="true" data-delay="5000" data-animation="true">
    <div class="toast-body">
    </div>
  </div>
  <!-- Scripts -->
  <script src="{{ mix('js/admin.js') }}" defer></script>

  @yield('script')
</body>

</html>
