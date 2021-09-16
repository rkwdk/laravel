<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// Route::get('/', function () {
//    return view('page.index');
// });
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/', function () {
    return view('page.adminlte');
});
Route::get('/home', function () {
    return view('page.adminlte');
});
Route::get('/settings', function () {
    return view('page.adminlte');
});
Route::get('/logout', function () {
    return view('page.adminlte');
});
