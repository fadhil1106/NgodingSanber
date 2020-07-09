@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Home</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Pertanyaan</a></li>
                <li class="breadcrumb-item active">Home</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <section class="col-lg-12 connectedSortable">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Pertanyaan</h3>
    
                    <div class="card-tools">
                      <ul class="pagination pagination-sm float-right">
                        {{ $questions->links() }}
                        {{-- <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li> --}}
                      </ul>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th style="width: 40px">
                            Votes
                          </th>
                          <th>Judul</th>
                          <th style="width: 150px">Tags</th>
                          <th style="width: 10px">Solved?</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($questions as $question)
                        <tr>
                          <td>{{ ++$count }}</td>
                          <td>{{ $votes[$question->id] }}</td>
                          <td>
                            <a href="#"> {{ $question->judul }} </a>
                          </td>
                          <td>
                            @foreach ($question->tag as $tag)
                              <i class="badge bg-primary">{{ $tag }}</i>
                            @endforeach
                          </td>
                          <td>
                            @if ($question->solved)  
                              <i class="icon-solved fas fa-check"></i>
                            @else
                              <i class="icon-not-solved fas fa-times"></i>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </section>
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection