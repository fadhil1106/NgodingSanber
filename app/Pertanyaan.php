<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $fillable = ['judul', 'isi', 'tag', 'user_id'];

    public function getTotalVotes($questionId)
    {
        $votes =  DB::table('vote_pertanyaan')
                    ->select(DB::raw('vote, count(vote) as total_vote'))
                    ->where('pertanyaan_id', $questionId)
                    ->groupBy('vote')
                    ->get();
        return $votes;
    }

    public function getUserQuestions($userId)
    {
        $questions = DB::table('pertanyaan')->where('user_id', $userId)->count();
        return $questions;
    }

    public function getSolvedUserQuestions($userId)
    {
        $questions = DB::table('pertanyaan')->where([['user_id', $userId],['solved', 1]])->count();
        return $questions;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jawaban()
    {
        return $this->hasMany('App\Jawaban');
    }

    public function votePertanyaan()
    {
        return $this->hasMany('App\VotePertanyaan');
    }
}
