<?php

namespace App\Http\Controllers;

use App\KomentarJawaban;
use App\KomentarPertanyaan;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class KomentarController extends Controller
{

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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        // $data = DB::table('komentar_pertanyaan')->where('id', $id)->get();
        // return $data;
    }

    public function show($id)
    {
        // Menghapus komentar,
        $test = KomentarPertanyaan::find($id)->delete();
        return back()->with('message','Jawaban berhasil dihapus!');
    }
}
