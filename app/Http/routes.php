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



Route::get('/', function () {
    return view('index');
});

Route::get('sequences', function () {
    return view('sequences');
});

Route::get('list', function () {
    $codonsAll = DB::table('codon')->get();
    $i = 0;
    $types = array();
    foreach($codonsAll as $codon) {
        if(!in_array(($codon->type), $types)) {
            $types[$i] = $codon->type;
            $i++;
        }
    }
   

    //return Response::json($tmp);
    // load the view and pass the nerds
    return View::make('list')
        ->with(array('codonsAll'=> $codonsAll, 'types' => $types ));
});

Route::get('upload', function () {
    return view('upload');
});
