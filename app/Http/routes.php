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
use Illuminate\Support\Facades\Input;


Route::get('/', function () {
    return view('index');
});

Route::get('index', function () {
    return view('index');
});

Route::get('sequences', function () {
    return view('sequences');
});


Route::post('search', function(){
   $sequence = Input::get('sequence'); 
   $sequence = strtoupper($sequence);
   $rf = str_split($sequence);
   $find = str_replace("*", "Z", $rf);
   $k = 0;
   foreach($find as $f){
       $triplets = DB::table('nucle')->where('amino', $f)->pluck('triplet');
       $freqs = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Synechocystis')->pluck('frequency');
       $freqp = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Penicillium roquefortii')->pluck('frequency');
       $freqe = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Escherichia coli')->pluck('frequency');
       $freqr = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Rhodococcus')->pluck('frequency');
       $distance = array();
       if(count($freqs) > 0){
           for ($i = 0; $i < count($freqe); $i++) {
                $distance[$i] = abs($freqs[$i]-$freqp[$i]) + abs($freqs[$i]-$freqe[$i]) + abs($freqs[$i]-$freqr[$i]) + abs($freqp[$i]-$freqe[$i]) + abs($freqp[$i]-$freqr[$i]) + abs($freqe[$i]-$freqr[$i]);
            }
            $valmin = min($distance);
            $keymin = array_search($valmin, $distance);
            $result[$k] = $triplets[$keymin];
       }
       else{
           $result[$k] = $triplets;
       }
        $k++;
        
   }
       
   //return Response::json($result);
   return View::make('result')
        ->with(array('result' => $result, 'rf' => $rf));
});

Route::post('searchv2', function(){
   $sequence = Input::get('sequence'); 
   $sequence = strtoupper($sequence);
   $rf = str_split($sequence);
   $find = str_replace("*", "Z", $rf);
   $k = 0;
   foreach($find as $f){
       $triplets = DB::table('nucle')->where('amino', $f)->pluck('triplet');
       $freqs = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Synechocystis')->pluck('frequency');
       $freqp = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Penicillium roquefortii')->pluck('frequency');
       $freqe = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Escherichia coli')->pluck('frequency');
       $freqr = DB::table('codon')->whereIn('triplet', $triplets)->where('type', 'Rhodococcus')->pluck('frequency');
       $distance = array();
       $all = array();
       $check = 0;
       $min = array();
       if(count($freqs) > 0){
           
           for ($i = 0; $i < count($freqe); $i++) {
                $all[0] = $freqs[$i];
                $all[1] = $freqp[$i];
                $all[2] = $freqe[$i];
                $all[3] = $freqr[$i];
                $diff = 0;
                
                if(max($all) > 5.0 && min($all) > 5.0){
                    for ($ii = 0; $ii < 3; $ii++){
                        $diff += abs($all[$ii] - $all[$ii+1]);
                    }
                    $diff = $diff/4;
                    $distance[$i] = $diff;
                    //$distance[$i] = abs($freqs[$i]-$freqp[$i]) + abs($freqs[$i]-$freqe[$i]) + abs($freqs[$i]-$freqr[$i]) + abs($freqp[$i]-$freqe[$i]) + abs($freqp[$i]-$freqr[$i]) + abs($freqe[$i]-$freqr[$i]);
                    $check++;
                }
                
                if($check == 0){
                    if(min($all) > 0){
                        $min[$i] = min($all);
                        for ($ii = 0; $ii < 3; $ii++){
                            $diff += abs($all[$ii] - $all[$ii+1]);
                        }
                        $diff = $diff/4;
                        $distance[$i] = $diff;
                        //$distance[$i] = abs($freqs[$i]-$freqp[$i]) + abs($freqs[$i]-$freqe[$i]) + abs($freqs[$i]-$freqr[$i]) + abs($freqp[$i]-$freqe[$i]) + abs($freqp[$i]-$freqr[$i]) + abs($freqe[$i]-$freqr[$i]);
                        //$check++;
                    }
                }
            }
            $valmin = min($distance);
            $keymin = array_search($valmin, $distance);
            $result[$k] = $triplets[$keymin];
       }
       else{
           $result[$k] = $triplets;
       }
        $k++;
        
   }

   //return Response::json($triplets);
   return View::make('result')
   ->with(array('result' => $result, 'rf' => $rf));
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
