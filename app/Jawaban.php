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

    public function komentarJawaban(){
        return $this->hasMany('App\KomentarJawaban');
    }

    public static function jawaban_tepat($request, $id){
        $reset = DB::table('jawaban')->update([
            'jawaban_tepat' => 0
        ]);
    
        $tepat = DB::table('jawaban')
            ->where('id', $id)
            ->update([
                'jawaban_tepat' => $request['tepat']
            ]);

        $solved = DB::table('pertanyaan')
            ->where('id', $request['question'])
            ->update([
               'solved' => $request['solved']
            ]);
        
        // Ngambil dulu data dari db, berapa reputasi usernya sebelum jawabanya di pilih sebagai jawaban paling tepat
        $ambil = DB::table('users')
            ->where('id', $request['user'])
            ->first();

        // Baru, ditambahin 15 deh reputasinya
        $reputaion = DB::table('users')
            ->where('id', $request['user'])
            ->update([
                'reputasi' => $ambil->reputasi + $request['reputasi']
            ]);

    }
}
