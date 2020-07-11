@extends('layouts.master')

@section('content')
<section class="content pt-2">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-1">
				<div class="row">

					@if ($question->user->id != Auth::user()->id)
					<button class="btn btn-vote-width">
						<span class="fas fa-thumbs-up fa-2x" style="color:#38c172"></span>
					</button>
					@endif

				</div>
				<div class="row">
					<div class="text-total-vote" style="text-align: center">
						<small> Votes </small><br>
						<strong>{{$question->vote}}</strong>
					</div>
				</div>
				<div class="row">

					@if ($question->user->id != Auth::user()->id)
					<button class="btn btn-vote-width">
						<span class="fas fa-thumbs-down fa-2x" style="color:#dc3545"></span>
					</button>
					@endif

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
							<dd>
								<blockquote class="mb-0 mt-1">

									@foreach ($question->komentarPertanyaan as $commentQuestion)
									<p>
										<small>
											{{ $commentQuestion->komentar }}. <br>
											<a href="#"><i>{{ $commentQuestion->user->name }}</i></a>
											<span class="ml-1"> {{ $commentQuestion->created_at }} </span>
											
											@if ($commentQuestion->user->id == Auth::user()->id)
											<a href="{{ route('komentar.destroy', $commentQuestion->id)}}" class="ml-2" style="color:#dc3545;">delete</a>
											<!-- <form action="/komentar/{{$commentQuestion->id}}" method="POST" class="d-inline">
												@method('DELETE')@csrf
												<button class="btn-danger"><i class="fas fa-trash"></i></button>
											</form> -->
											@endif

										</small>
									</p>
									@endforeach

								</blockquote>
							</dd>
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
			<h3 class="m-1 text-dark">{{ $answers->count() }} Jawaban</h3>
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

				@if ($answer->user->id != Auth::user()->id)
				<button class="btn btn-vote-width">
					<span class="fas fa-thumbs-up fa-2x" style="color:#38c172"></span>
				</button>
				@endif

			</div>
			<div class="row">
				<div class="text-total-vote" style="text-align: center">
					<strong>{{$answer->vote}}</strong>
				</div>
			</div>
			<div class="row">

				@if ($answer->user->id != Auth::user()->id)
				<button class="btn btn-vote-width">
					<span class="fas fa-thumbs-down fa-2x" style="color:#dc3545"></span>
				</button>
				@endif

			</div>
		</div>
		<div class="col-md-11">
			@if ($answer->jawaban_tepat)	
				<div class="card card-outline card-success">
			@else
				<div class="card">
			@endif
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
				@if ($answer->komentarJawaban->count() != 0)
				<div class="card-body">
					<dd>
						<blockquote class="mb-0 mt-0">
							@foreach ($answer->komentarJawaban as $commentAnswer)
							<p>
								<form class="m-0" action="" method="post">
									<small>
										{{ $commentAnswer->komentar }}. <br>
										<a href="#"><i>{{ $commentAnswer->user->name }}</i></a>
										<span class="ml-2"> {{ $commentAnswer->created_at }} </span>

										@if ($commentAnswer->user->id == Auth::user()->id)
										<br>
										<span>
											<button class="btn btn-xs p-0" style="color:#dc3545;">delete</button>
										</span>
										@endif

									</small>
								</form>
							</p>
							@endforeach
						</blockquote>
					</dd>
				</div>
				@endif
				<div class="card-footer">
					<form action="{{ route('komentar.store') }}" method="post">
						@csrf
						<div class="input-group">
							<input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
							<input type="text" name="jawaban_id" value="{{ $answer->id }}" hidden>
							<input type="text" name="pertanyaan_id" value="{{ $question->id }}" hidden>
							<input type="text" name="komentar" placeholder="Tulis Komentar ..." class="form-control">
							<span class="input-group-append">
								<button type="submit" class="btn btn-primary">Kirim</button>
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