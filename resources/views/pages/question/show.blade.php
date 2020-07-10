@extends('layouts.master')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-1">
						<div class="row">
							<button class="btn btn-vote-width">
								<span class="fas fa-sort-up fa-3x" style="color:#38c172"></span>
							</button>
						</div>
						<div class="row">
							<div class="text-total-vote" style="text-align: center">
								<strong>{{$question->vote}}</strong>
							</div>
						</div>
						<div class="row">
							<button class="btn btn-vote-width">
								<span class="fas fa-sort-down fa-3x" style="color:#dc3545"></span>
							</button>
						</div>
				</div>
				<div class="col-md-10">
					<div class="card">
						<div class="card-header">
							<strong>{{$question->judul}}</strong>
						</div>
						<div class="card-body">
							<p>{{$question->isi}}</p>
						</div>
						<div class="row ml-3 mr-3 mb-2">
							<div>Dari : <span class="text-primary">{{$question->user->name}}</span></div>
						</div>
					</div>
				</div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
@endsection