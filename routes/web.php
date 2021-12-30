<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('users', UserController::class);
    Route::resource('films', FilmController::class);
    Route::resource('home', HomeController::class);
});
Route::view('/','welcome');

Route::group(['middleware' => ['role:Cliente']], function(){
    Route::get('/available', [App\Http\Controllers\FilmController::class, 'indexFilmAvailable']);
    Route::view('/available','/films/available');
    Route::post('/available','App\Http\Controllers\FilmController@listFilm');
    Route::view('/rented-films', 'rentedFilms');
    Route::post('/home/films-rent','App\Http\Controllers\FilmController@rentFilm');
    Route::post('/return-films','App\Http\Controllers\FilmController@returnFilm');
    Route::post('/rented-films/list','App\Http\Controllers\FilmController@listFilmRent');
});

Auth::routes();
Route::group(['middleware' => ['role:Administrador']], function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('/sales-list','/users/salesList');
    Route::post('/sales-list','App\Http\Controllers\UserController@salesList');
    Route::view('/sales-rent-list','/users/salesRentList');
    Route::post('/sales-rent-list','App\Http\Controllers\UserController@salesRentList');
});




