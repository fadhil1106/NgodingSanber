<div class="modal fade" id="modal-new-answer" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Jawab Pertanyaan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @if (Auth::check())
      <form method="POST" action="{{ route('jawaban.store') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
            <input type="text" name="pertanyaan_id" value="{{ $question->id }}" hidden>
            <label for="jawaban">Jawaban</label>
            <textarea class="form-control @error('jawaban') is-invalid @enderror" id="jawaban" name="jawaban" rows="10"
              cols="80">{{ old('jawaban')}}</textarea>
            @error('jawaban')
            <div class="invalid-feedback" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Jawab</button>
        </div>
      </form>
      @else
      <div class="modal-body">
        Anda Belum Login
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
      </div>
      @endif
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@auth
<script>
  CKEDITOR.replace('jawaban');
</script>
@endauth