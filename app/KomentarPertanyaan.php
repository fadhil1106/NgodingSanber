<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarPertanyaan extends Model
{
    protected $table = 'komentar_pertanyaan';

    protected $fillable = ['komentar', 'user_id', 'pertanyaan_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
}
