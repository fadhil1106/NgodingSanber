@extends('layouts.master')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Pertanyaan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Pertanyaan</a></li>
          <li class="breadcrumb-item active">Edit Pertanyaan</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="card">
      <div class="card-body">
        <form method="POST" action="/pertanyaan/{{$data->id}}">
        @method('PUT')
        @csrf
          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ $data->judul}}">
            @error('judul')
            <div class="invalid-feedback" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="isi">Isi</label>
            <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="3">{{ $data->isi}}</textarea>
            @error('isi')
            <div class="invalid-feedback" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="tag">tag</label>
            <input type="text" class="form-control @error('tag') is-invalid @enderror" id="tag" name="tag" value="{{ $data->tag}}">
            <small id="emailHelp" class="form-text">Pisahkan tag dengan tanda koma (,) untuk tiap tagnya</small>
            @error('tag')
            <div class="invalid-feedback" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
      </div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
@endsection

@push('script')

@endpush