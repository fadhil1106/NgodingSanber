<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotePertanyaan extends Model
{
    protected $table = 'vote_pertanyaan';

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
}
