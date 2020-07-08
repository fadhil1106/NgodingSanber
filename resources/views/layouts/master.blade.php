@include('layouts.header')

@include('layouts.navbar')

@include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

@include('layouts.footer')