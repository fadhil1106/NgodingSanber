<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Pertanyaan;
use App\Jawaban;
use App\KomentarPertanyaan;
use App\VotePertanyaan;
use Illuminate\Support\Facades\Session;

class PertanyaanController extends Controller
{

    public function index()
    {
        $questions = Pertanyaan::orderBy('solved', 'desc')->paginate(15);
        $pertanyaan = new Pertanyaan;
        foreach ($questions as $index => $question) {
            $questions[$index]->tag = explode(',',$question->tag);
            $vote = $pertanyaan->getTotalVotes($question->id);
            $questions[$index]->vote = $this->getTotalVote($vote);
        }
        // dd($questions);
        return view('pages.question.index', compact(['questions']));
    }

    public function create()
    {
        return view('pages.myquestion.new');
    }

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'judul' => 'required|min:10',
            'isi' => 'required|min:10',
            'tag' => 'required'
        ]);

        $new = Pertanyaan::new_question($request, $id);
        return redirect()->route('pertanyaan.home')->with('message', 'Pertanyaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Pertanyaan::findOrFail($id);
        $answers = Jawaban::where('pertanyaan_id', $id)->orderBy('jawaban_tepat', 'desc')->get();
        // dd($commentsQuestion);
        $pertanyaan = new Pertanyaan;
        $jawaban = new Jawaban;
        $question->tag = explode(',',$question->tag);
        
        $votePertanyaan = $pertanyaan->getTotalVotes($question->id);
        $question->vote = $this->getTotalVote($votePertanyaan);
        
        foreach ($answers as $index => $answer) {
            $votePertanyaan = $jawaban->getTotalVotes($answer->id);
            $answers[$index]->vote = $this->getTotalVote($votePertanyaan);
        }

        $answers = $answers->sortByDesc(function($answer)
        {
           return $answer->vote; 
        });
        // dd($answers);
        
        return view('pages.question.show', compact(['question', 'answers']));
    }

    public function edit($id)
    {
        $data = Pertanyaan::find($id);
        return view('pages.myquestion.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {

        $edit = Pertanyaan::edit($request, $id);
        return redirect('/pertanyaan')->with('message', 'Pertanyaan berhasil diperbarui');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        // Pertanyaan::where('id',$id)->delete();
        return redirect('/myquestion');
    }

    public function UpdateVotePertanyaan(Request $request, $id)
    {
        $question = Pertanyaan::find($id);
        $reputasi = $question->user->reputasi;
        $user = User::find($question->user_id);

        $dataVote = VotePertanyaan::where([['user_id', '=', Auth::user()->id],['pertanyaan_id', '=', $question->id]])->get();
        if (Auth::check()) {
            if ($dataVote->isEmpty())  { 
                if ($request->vote == 'upvote') {
                    $user->reputasi = $reputasi+10;
                }elseif($request->vote == 'downvote'){
                    $user->reputasi = $reputasi-1;
                }
                $user->save();
                $this->saveVote($request, $question->user_id, $id);
            } else {
                
            }
        }
        return back();
    }

    public function saveVote($request, $userId, $pertanyaanId)
    {
        // dd($request->vote);
        VotePertanyaan::create(
            ['vote' => $request->vote, 
            'user_id' => $userId,
            'pertanyaan_id' => $pertanyaanId
            ]
        );
    }

    public function getTotalVote($dataVote)
    {
        $result = 0;
        if (isset($dataVote[0])) {
            if (isset($dataVote[1])) {
                $result = $dataVote[0]->total_vote - $dataVote[1]->total_vote;
            }else{
                if ($dataVote[0]->vote == 'upvote') {
                    $result = $dataVote[0]->total_vote;
                }else{
                    $result = 0 - $dataVote[0]->total_vote;
                }
            }
        }else{
            $result = 0;
        }
        return $result;
    }
}
