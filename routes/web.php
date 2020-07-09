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

Auth::routes();

Route::get('/', function () {
    return redirect('/pertanyaan');
})->name('home');

Route::resource('pertanyaan', 'PertanyaanController', 
                ['names' => [ 
                    'create' => 'pertanyaan.create',
                    'show' => 'pertanyaan.show',
                    'destroy' => 'pertanyaan.destroy'
                ]]
);

Route::get('/myquestion', 'HomeController@index');