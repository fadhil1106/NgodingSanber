<?php

namespace App\Http\Controllers;

use App\KomentarJawaban;
use App\KomentarPertanyaan;

use Illuminate\Http\Request;

class KomentarController extends Controller
{

    public function store(Request $request)
    {
        // dd($request);
        if (isset($request->pertanyaan_id)) {
            KomentarPertanyaan::create($request->all());
        }elseif(isset($request->pertanyaan_id)){
            KomentarJawaban::create($request->all());
        }
        $request->session()->flash('message', 'Komentar ditambahkan');
        return redirect()->route('pertanyaan.show', $request->pertanyaan_id);
    }
    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
