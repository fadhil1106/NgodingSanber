<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Pertanyaan;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Pertanyaan::orderBy('solved', 'desc')->paginate(15);
        $pertanyaan = new Pertanyaan;
        $myQuestions = 0;
        $solvedQuestions = 0;
        if (Auth::check()) {
            $myQuestions = $pertanyaan->getUserQuestions(Auth::user()->id);
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
            }
        }
        // dd($solvedQuestions);
        return view('pages.question.index', compact(['questions', 'myQuestions', 'solvedQuestions', 'votes']));
    }

    public function create()
    {
        return view('pages.question.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
