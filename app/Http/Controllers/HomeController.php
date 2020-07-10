<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Pertanyaan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $questions = Pertanyaan::where('user_id', Auth::user()->id)->get();
        $pertanyaan = new Pertanyaan;
        $myQuestions = 0;
        $solvedQuestions = 0;
        if (Auth::check()) {
            $myQuestions = $pertanyaan->getUserQuestions(Auth::user()->id)->count();
            $solvedQuestions = $pertanyaan->getSolvedUserQuestions(Auth::user()->id);
        }
        foreach ($questions as $index => $question) {
            $questions[$index]->tag = explode(',',$question->tag);
            $vote = $pertanyaan->getTotalVotes($question->id);
            $questions[$index]->vote = $this->getTotalVote($vote);
        }
        // dd($questions);
        return view('pages.myquestion.index', compact(['questions', 'myQuestions', 'solvedQuestions']));
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