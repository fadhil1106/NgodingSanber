<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
}
