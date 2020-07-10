<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $table = 'komentar_jawaban';

    protected $fillable = ['komentar', 'user_id', 'jawaban_id', 'pertanyaan_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
}
