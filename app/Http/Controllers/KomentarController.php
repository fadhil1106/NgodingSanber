<?php

namespace App\Http\Controllers;

use App\KomentarJawaban;
use App\KomentarPertanyaan;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomentarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'komentar' => 'required|min:5'
        ]);
        if ($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        if (isset($request->jawaban_id)) { //harus cek jawaban dulu sebelum pertanyaan
            KomentarJawaban::create($request->all());
        }elseif(isset($request->pertanyaan_id)){
            KomentarPertanyaan::create($request->all());
        }
        $request->session()->flash('message', 'Komentar ditambahkan');
        return back();
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
}