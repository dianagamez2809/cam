<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use DB;

Route::get('/', function () {
    return view('index');
});

Route::get('sequences', function () {
    return view('sequences');
});

Route::get('list', function () {
    $codons = DB::table('codon')->get();

    // load the view and pass the nerds
    return View::make('list')
        ->with('codons', $codons);
});

Route::get('upload', function () {
    return view('upload');
});
