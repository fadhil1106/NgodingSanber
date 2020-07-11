<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';

    protected $fillable = ['judul', 'isi', 'tag', 'user_id'];

    protected $appends = ['vote' => 0];

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
        $questions = DB::table('pertanyaan')->where('user_id', $userId);
        return $questions;
    }

    public function getSolvedUserQuestions($userId)
    {
        $questions = DB::table('pertanyaan')->where([['user_id', $userId],['solved', 1]])->count();
        return $questions;
    }

    public function getVoteAttribute()
    {
        return $this->appends['vote'];
    }

    public function setVoteAttribute($value)
    {
        $this->appends['vote'] = $value;
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

    public function komentarPertanyaan(){
        return $this->hasMany('App\KomentarPertanyaan');
    }

    public static function new_question($data, $id)
    {
        $new = DB::table('pertanyaan')->insert([
            'judul' => $data['judul'],
            'isi' => $data['isi'],
            'tag' => $data['tag'],
            'user_id' => $id
        ]);
        return $data;
    }

    public static function edit($data, $id)
    {
        $edit = DB::table('pertanyaan')
            ->where('id', $id)
            ->update([
                'judul' => $data['judul'],
                'isi' => $data['isi'],
                'tag' => $data['tag'] 
            ]);

        return $edit;
    }
}
