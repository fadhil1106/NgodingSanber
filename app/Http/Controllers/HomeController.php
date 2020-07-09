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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $questions = Pertanyaan::where('user_id', Auth::user()->id)->paginate(15);
        $pertanyaan = new Pertanyaan;
        $myQuestions = 0;
        $solvedQuestions = 0;
        if (Auth::check()) {
            $myQuestions = $pertanyaan->getUserQuestions(Auth::user()->id)->count();
            $solvedQuestions = $pertanyaan->getSolvedUserQuestions(Auth::user()->id);
        }
        //Get Vote for each Question
        $votes = array();
        foreach ($questions as $index => $question) {
            $questions[$index]->tag = explode(',',$question->tag);
            $vote = $pertanyaan->getTotalVotes($question->id);
            if (isset($vote[0])) {
                if (isset($vote[1])) {
                    $votes[$question->id] = $vote[0]->total_vote - $vote[1]->total_vote;
                }else{
                    if ($vote[0]->vote == 'upvote') {
                        $votes[$question->id] = $vote[0]->total_vote;
                    }else{
                        $votes[$question->id] = 0 - $vote[0]->total_vote;
                    }
                }
            }else{
                $votes[$question->id] = 0;
            }
        }
        // dd($questions);
        return view('pages.myquestion.index', compact(['questions', 'myQuestions', 'solvedQuestions', 'votes']));
    }
}