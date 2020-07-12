<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jawaban;
use App\VoteJawaban;
use App\User;


class JawabanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jawaban' => 'required|min:10'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        Jawaban::create($request->all());
        return back()->with('message', 'Jawaban berhasil dibuat');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jawaban' => 'required|min:10'
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = Jawaban::jawaban_tepat($request, $id);
        // dump($data)
        return back();
    }

    public function destroy($id)
    {
        $data = Jawaban::find($id);
        // dd($data);
        $data->delete();
        return back()->with('message', 'Jawaban berhasil dihapus');
    }

    public function UpdateVoteJawaban(Request $request, $id)
    {
        $message='';
        $jawaban = Jawaban::find($id);
        $dataVote = VoteJawaban::where([['user_id', '=', Auth::user()->id], ['jawaban_id', '=', $jawaban->id]])->get();
        if (Auth::check()) {
            if ($dataVote->isEmpty()) {
                $reputasi = $jawaban->user->reputasi;
                $user = User::find($jawaban->user_id);
                if ($request->vote == 'upvote') {
                    $user->reputasi = $reputasi + 10;
                } elseif ($request->vote == 'downvote') {
                    $user->reputasi = $reputasi - 1;
                }
                $user->save();
                $this->saveVote($request, $jawaban->user_id, $id);
                $message = 'Berhasil Melakukan Vote';
            } else {
                $message = 'Sudah Melakukan Vote';
            }
        }
        return back()->with('message', $message);
    }

    public function saveVote($request, $userId, $jawabanId)
    {
        // dd($request->vote);
        VoteJawaban::create(
            ['vote' => $request->vote, 
            'user_id' => $userId,
            'jawaban_id' => $jawabanId
            ]
        );
    }
}
