<?php

namespace App\Http\Controllers;

use App\KomentarJawaban;
use App\KomentarPertanyaan;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if (isset($request->jawaban_id)) { //harus cek jawaban dulu sebelum pertanyaan
            KomentarJawaban::create($request->all());
        }elseif(isset($request->pertanyaan_id)){
            KomentarPertanyaan::create($request->all());
        }
        $request->session()->flash('message', 'Komentar ditambahkan');
        return redirect()->route('pertanyaan.show', $request->pertanyaan_id);
    }
    
    public function edit($id)
    {
        $data = KomentarPertanyaan::where('id', $id)->get();
        return view('');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $message = '';
        if (KomentarPertanyaan::find($id) !== null) {
            $komentar = KomentarPertanyaan::find($id);
            $komentar->delete();
            $message = 'Success delete komentar pertanyaan!';
        }elseif(KomentarJawaban::find($id) !== null){
            $komentar = KomentarJawaban::find($id);
            $komentar->delete();
            $message = 'Success delete komentar jawaban!';
        }
        return back()->with('message',$message);
    }

    public function show($id)
    {
        
    }
}