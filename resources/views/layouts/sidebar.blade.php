<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <strong class="ml-3"> NS </strong>
      <span class="brand-text font-weight-light">NgodingSanber</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="ml-0 pb-3 mb-1 d-flex">
        <div class="brand-link">
          @if (Auth::user())  
            <strong class="ml-3"> A </strong>
            <span class="brand-text font-weight-light">Alexander Pierce</span>
          @else
            <strong class="ml-3"> G </strong>
            <span class="brand-text font-weight-light">Guest</span>
          @endif
        </div>
      </div>
      @if (!Auth::user())
        <a href="{{ route('login') }}" type="button" class="btn btn-block btn-outline-primary btn-sm">Signin</a>
        <a href="{{ route('register') }}" type="button" class="btn btn-block btn-outline-success btn-sm">Signup</a>
      @endif

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p>
                Buat Pertanyaan
              </p>
            </a>
          </li>
          
          <li class="nav-header">Halaman Pribadi</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Pertanyaan Anda
              </p>
            </a>
          </li>
        </ul>
        @auth
          <div class="mt-3">
            <a href="{{ Auth::logout() }}" type="button" class="btn btn-block btn-outline-danger btn-sm">Logout</a>
          </div>
        @endauth
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>