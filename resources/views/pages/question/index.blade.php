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

      @if (session('message'))
      <div class="alert alert-info">
        {{ session('message') }}
      </div>
      @endif
      
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
                        {{-- {{ $questions->links() }} --}}
                      </ul>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-striped dataTable dtr-inline" role="grid"
                      aria-describedby="example1_info">
                      <thead>
                        <tr role="row">
                          <th style="width: 40px" tabindex="0" rowspan="1" colspan="1">Votes</th>
                          <th tabindex="0" rowspan="1" colspan="1">Judul</th>
                          <th style="width: 150px" tabindex="0" rowspan="1" colspan="1">Tags</th>
                          <th style="width: 10px" tabindex="0" rowspan="1" colspan="1">Solved?</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($questions as $question)
                        <tr role="row">
                          <td>{{ $question->vote }}</td>
                          <td>
                            <a href="{{ route('pertanyaan.show',$question->id) }}"> {{ $question->judul }} </a>
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

@push('script')
    <script>
      $('#example1').DataTable({
      "order": [[0, "desc"]],
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    </script>
@endpush
