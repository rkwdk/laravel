<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return view('page.index');
});

Route::get('/test', function () {
    return view('page.test',[ 'nums' => rand() ]);
 });
