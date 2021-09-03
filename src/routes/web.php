<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
   return view('page.index');
});

Route::get('/test', function () {
    return view('page.test',[ 'nums' => rand() ]);
 });

//  Route::get('/test2', function () {
//      ///TODO 使い道がわからない
//     return View::first(['page.test','page.second'],[ 'nums' => 0 ]);
//  });

 if (View::exists('page.second')) {
    Route::get('/test2', function () {
        return view('page.second',[ 'nums' => rand() ]);
     });
} else {
    Route::get('/test2', function () {
        return view('page.error');
     });
}
