<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $table = 'komentar_jawaban';

    protected $fillable = ['komentar', 'user_id', 'jawaban_id'];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban');
    }
}
