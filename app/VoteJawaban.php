<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteJawaban extends Model
{
    protected $table = 'vote_jawaban';

    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban');
    }
}
