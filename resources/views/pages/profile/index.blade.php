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
      @if(session('message'))
        <div class="alert alert-info">{{ session('message')}}</div>
      @endif
      @error('photo')
        <div class="alert alert-warning">Anda belum memilih file</div>
      @enderror
        <!-- Add the bg color to the header using any of the bg-* classes -->

        @Auth
          @if($profile->id == Auth::user()->id)
          <a href="#" class="mt-3 mr-4 text-right text-info" data-toggle="modal" data-target="#updatePhotoModal">
            Perbarui Foto <i class="fas fa-edit"></i>
          </a>
          @endif
        @endauth
        <div class="user-image mt-4">
          <img class="img-circle elevation-2" src="{{ asset('/images/profiles/'.$profile->photo)}}" alt="User Avatar" width="250px">
        </div>
        <div class="text-center mt-4">
          <h3 class="widget-user-username">{{ $profile->name }}</h3>
          <span class="btn btn-default"><i class="fas fa-envelope"></i> {{ $profile->email }}</span>
          <!-- <span class="btn btn-default">Phone: 081243880124</span> -->
        </div>
        <div class="container">
          <div class="row mt-4">
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger pl-3">
              <div class="inner">
                <h3>{{ $profile->reputasi }}</h3>
                <p>Reputasi</p>
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
                <h3>{{$pertanyaan->count()}}</h3>
                
                <p>Pertanyaan</p>
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
                <h3>{{ $solved->count() }}</h3>
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

  <!-- upload photo modal -->

  <div class="modal fade" role="dialog" id="updatePhotoModal" aria-labelledby="updatePhotoModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content"><div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/profile/{{ $profile->id }}" method="POST" enctype="multipart/form-data">
        @method('PUT')@csrf
        <input type="file" name="photo">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div></div>
    </div>

  
  </div>
  @endsection