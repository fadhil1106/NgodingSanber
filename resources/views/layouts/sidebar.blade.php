<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <strong class="ml-3"> NS </strong>
      <span class="brand-text font-weight-light">NgodingSanber</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->  
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            @if (Auth::user())
              <img src="{{ asset('images/profiles/mas mas.png')}}" class="img-circle elevation-2">
            @else
              <img src="{{ asset('images/profiles/boxed-bg.png')}}" class="img-circle elevation-2">
            @endif
            </div>
            <div class="info">
              @if (Auth::user())
              <a href="{{ url('/profile')}}" class="d-block">{{ Auth::user()->name }}</a>
              @else
              <a href="{{ route('login')}}" class="d-block">Guest</a>
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
            <a href="{{ route('home') }}" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          @auth
          <li class="nav-item">
            <a href="/pertanyaan/create" class="nav-link">
              <i class="nav-icon fas fa-plus-square"></i>
              <p>
                Buat Pertanyaan
              </p>
            </a>
          </li>
          <li class="nav-header">Halaman Pribadi</li>
          <li class="nav-item">
            <a href="{{ url('myquestion') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Pertanyaan Anda
              </p>
            </a>
          </li>
        </ul>
          <div class="mt-3">
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="btn btn-block btn-outline-danger btn-sm">Logout</button>
            </form>
          </div>
        @endauth
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>