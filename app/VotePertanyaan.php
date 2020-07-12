<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotePertanyaan extends Model
{
    protected $table = 'vote_pertanyaan';

    protected $fillable = ['vote', 'user_id', 'pertanyaan_id'];

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }
}
