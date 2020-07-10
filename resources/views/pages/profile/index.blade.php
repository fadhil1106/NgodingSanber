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
        <div class="widget-user-header bg-info">
          <h3 class="widget-user-username">{{ $profile->name }}</h3>
          <h5 class="widget-user-desc">Founder & CEO</h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle elevation-2" src="{{ asset('images/mas mas.png')}}" alt="User Avatar">
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h1 class="description-header">{{$profile->reputasi}}</h1>
                <span class="description-text">Reputation</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-6 border-right">
              <div class="description-block">
                <h5 class="description-header">13,000</h5>
                <span class="description-text">Question</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
    </section>
  </div>
  <!-- /.content -->
@endsection