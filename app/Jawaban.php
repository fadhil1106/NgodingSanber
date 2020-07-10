<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    
    protected $fillable = ['jawaban', 'jawaban_tepat', 'pertanyaan_id', 'user_id'];

    protected $appends = ['vote' => 0];

    public function getTotalVotes($answerId)
    {
        $votes =  DB::table('vote_jawaban')
                    ->select(DB::raw('vote, count(vote) as total_vote'))
                    ->where('jawaban_id', $answerId)
                    ->groupBy('vote')
                    ->get();
        return $votes;
    }

    public function getVoteAttribute()
    {
        return $this->appends['vote'];
    }

    public function setVoteAttribute($value)
    {
        $this->appends['vote'] = $value;
    }

    public function pertanyaan()
    {
        return $this->belongsTo('App\Pertanyaan');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
