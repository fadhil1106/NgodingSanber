@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/profile') }}">Profile</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
  
  <!-- Main content -->
  <div class="container">
    <section class="content">
      <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <a href="#" class="mt-3 mr-4 text-right text-info">
          Perbarui Profile <i class="fas fa-edit"></i>
        </a>
        <div class="user-image my-4">
          <img class="img-circle elevation-2" src="{{ asset('images/mas mas.png')}}" alt="User Avatar">
          <h3 class="widget-user-username mt-4">{{ $profile->name }}</h3>
        </div>
        <div class="widget-user-header bg-info">
          <h5 class="widget-user-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque nostrum, eligendi id perspiciatis sequi consectetur dolores ab in dolorum possimus, reprehenderit, pariatur minima perferendis voluptatem aspernatur obcaecati consequuntur laboriosam mollitia.</h5>
        </div>
        <div class="container">
          <div class="row mt-4">
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger pl-3">
              <div class="inner">
                <h3>{{ Auth::user()->reputasi }}</h3>
                <p>Reputasi Saya</p>
              </div>
              <div class="icon">
                <i class="ion ion-heart"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning pl-3">
              <div class="inner">
                <h3>99</h3>
                
                <p>Pertanyaan Saya</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success pl-3">
              <div class="inner">
                <h3>99</h3>
                <p>Terjawab</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
            </div>
          </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>
  </div>
  <!-- /.content -->
  @endsection