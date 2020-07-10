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
						<div class="card-title">
							<p><span class="text-primary">{{$question->user->name}}</span></p>
							<strong>{{$question->judul}}</strong>
						</div>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<p>{{$question->isi}}</p>
						<div class="row">
							<div><strong>Komentar</strong></div>
						</div>
						<div class="row">
							{{-- @foreach ($comments as $comment) --}}
								<dd><blockquote class="mb-0 mt-1">
									<p><small>. <br><a href="#"><i>Nama Pengkomentar</i></a></small></p>
								</blockquote></dd>
							{{-- @endforeach --}}
						</div>
					</div>
					@auth
					<div class="card-footer">
						<form action="{{ route('komentar.store') }}" method="post">
							@csrf
							<div class="input-group">
								<input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
								<input type="text" name="pertanyaan_id" value="{{ $question->id }}" hidden>
								<input type="text" name="komentar" placeholder="Tulis Komentar ..." class="form-control">
								<span class="input-group-append">
									<button type="submit" class="btn btn-primary">Kirim</button>
								</span>
							</div>
						</form>
					</div>
					@endauth
				</div>
			</div>
		</div>
	</div><!-- /.container-fluid -->

	<div class="row mb-4">
		<div class="col-md-10">
			<h3 class="m-1 text-dark">Jawaban</h3>
		</div><!-- /.col -->
		<div class="col-md-2">
			<button type="button" class="btn btn-md btn-success col-md-12" data-card-widget="collapse">
				Tambah Jawaban
			</button>
		</div>
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
					<strong>{{$answer->vote}}</strong>
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
					<div class="card-title">
						<p>{{$answer->jawaban}}</p>
						<div><span class="text-primary">{{$answer->user->name}}</span></div>
					</div>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
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