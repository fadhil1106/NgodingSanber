@extends('layouts.master')

@section('content')
<section class="content pt-2">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-1">
				<div class="row">
					<button class="btn btn-vote-width">
						<span class="fas fa-thumbs-up fa-2x" style="color:#38c172"></span>
					</button>
				</div>
				<div class="row">
					<div class="text-total-vote" style="text-align: center">
						<strong>{{$question->vote}}</strong>
					</div>
				</div>
				<div class="row">
					<button class="btn btn-vote-width">
						<span class="fas fa-thumbs-down fa-2x" style="color:#dc3545"></span>
					</button>
				</div>
			</div>
			<div class="col-md-11">
				<div class="card">
					<div class="card-header">
						<strong>{{$question->judul}}</strong>
					</div>
					<div class="card-body">
						<p>{{$question->isi}}</p>
					</div>
					<div class="row ml-3 mr-3 mb-2">
						<div>Pertanyaan : <span class="text-primary">{{$question->user->name}}</span></div>
					</div>
					<div class="card-footer">
						<form action="#" method="post">
							<div class="input-group">
								<input type="text" name="message" placeholder="Tulis Komentar ..." class="form-control">
								<span class="input-group-append">
									<button type="button" class="btn btn-primary">Kirim</button>
								</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.container-fluid -->

	<div class="row">
		<div class="col-sm-6">
			<h3 class="m-1 text-dark">Jawaban</h3>
		</div><!-- /.col -->
	</div>
	@foreach ($answers as $answer)
	<div class="row">
		<div class="col-md-1">
			<div class="row">
				<button class="btn btn-vote-width">
					<span class="fas fa-thumbs-up fa-2x" style="color:#38c172"></span>
				</button>
			</div>
			<div class="row">
				<div class="text-total-vote" style="text-align: center">
					<strong></strong>
				</div>
			</div>
			<div class="row">
				<button class="btn btn-vote-width">
					<span class="fas fa-thumbs-down fa-2x" style="color:#dc3545"></span>
				</button>
			</div>
		</div>
		<div class="col-md-11">
			<div class="card">
				<div class="card-header">
					<div><span class="text-primary">{{$answer->user->name}}</span></div>
				</div>
				<div class="card-body">
					<p>{{$answer->jawaban}}</p>
				</div>
				<div class="card-footer">
					<form action="#" method="post">
						<div class="input-group">
							<input type="text" name="message" placeholder="Tulis Komentar ..." class="form-control">
							<span class="input-group-append">
								<button type="button" class="btn btn-primary">Kirim</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	</div>
	<!-- /.row (main row) -->
</section>
@endsection