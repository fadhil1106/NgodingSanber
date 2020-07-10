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
        foreach ($questions as $index => $question) {
            $questions[$index]->tag = explode(',',$question->tag);
            $vote = $pertanyaan->getTotalVotes($question->id);
            if (isset($vote[0])) {
                if (isset($vote[1])) {
                    $questions[$index]->vote = $vote[0]->total_vote - $vote[1]->total_vote;
                }else{
                    if ($vote[0]->vote == 'upvote') {
                        $questions[$index]->vote = $vote[0]->total_vote;
                    }else{
                        $questions[$index]->vote = 0 - $vote[0]->total_vote;
                    }
                }
            }else{
                $questions[$index]->vote = 0;
            }
        }
        // dd($questions);
        return view('pages.question.index', compact(['questions']));
    }

    public function create()
    {
        return view('pages.myquestion.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tag' => 'required'
        ]);

        $new = Pertanyaan::new_question($request, $id);
        return redirect()->route('pertanyaan.home')->with('status', 'Pertanyaan berhasil ditambahkan');
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
        $pertanyaan = new Pertanyaan;
        $question->tag = explode(',',$question->tag);
        $vote = $pertanyaan->getTotalVotes($question->id);
        if (isset($vote[0])) {
            if (isset($vote[1])) {
                $question->vote = $vote[0]->total_vote - $vote[1]->total_vote;
            }else{
                if ($vote[0]->vote == 'upvote') {
                    $question->vote = $vote[0]->total_vote;
                }else{
                    $question->vote = 0 - $vote[0]->total_vote;
                }
            }
        }else{
            $question->vote = 0;
        }
        // dd($questions);
        return view('pages.question.show', compact(['question']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pertanyaan::find($id);
        return view('pages.myquestion.edit', compact('data'));
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
        $edit = Pertanyaan::edit($request, $id);

        return redirect('/pertanyaan')->with('status', 'Pertanyaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        // Pertanyaan::where('id',$id)->delete();
        return redirect('/myquestion');
    }
}
