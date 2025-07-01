<?php

use Illuminate\Support\Facades\Route;



require __DIR__.'/admin.php';


// // //for unknown url from vue 
// Route::get('/{any}', function(){
//     return view('layouts.app');
// })->where('any', '.*');


// Included routes
require __DIR__.'/auth.php';

