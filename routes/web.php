<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::resource('pertanyaan', 'PertanyaanController', ['names' =>[
    'index'     => 'pertanyaan.home',
    'create'    => 'pertanyaan.create',
    'show'      => 'pertanyaan.show',
    'destroy'   => 'pertanyaan.destroy' 
]]);

Route::post('pertanyaan/{pertanyaan}/vote', 'PertanyaanController@UpdateVotePertanyaan')->name('vote.pertanyaan');
Route::post('jawaban/{jawaban}/vote', 'JawabanController@UpdateVoteJawaban')->name('vote.jawaban');

Route::resource('komentar', 'KomentarController', ['names' =>[
    'store'    => 'komentar.store',
    'update'   => 'komentar.update',
    'destroy'   => 'komentar.destroy'
]]);


Route::resource('jawaban', 'JawabanController', ['names' =>[
    'store'    => 'jawaban.store',
    'update'   => 'jawaban.update',
    'destroy'   => 'jawaban.destroy'
]]);

Route::get('/myquestion', 'HomeController@index')->name('myhome');


Route::get('/', function () {
    return redirect()->route('pertanyaan.home');
})->name('home');

Auth::routes();

Route::resource('/profile', 'ProfileController');
