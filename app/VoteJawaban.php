<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteJawaban extends Model
{
    protected $table = 'vote_jawaban';

    protected $fillable = ['vote', 'user_id', 'jawaban_id'];

    public function jawaban()
    {
        return $this->belongsTo('App\Jawaban');
    }
}
