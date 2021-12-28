<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
Route::group(['middleware' => ['auth']], function (){
   Route::resource('roles',RolController::class);
   Route::resource('users',UserController::class);
   Route::resource('films',FilmController::class);
   Route::resource('home',HomeController::class);
});
Route::view('/','welcome');
Route::view('/rented-films','rentedFilms');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::post('/home','App\Http\Controllers\FilmController@listFilm')->name('listFilm');
Route::post('/home/films-list','App\Http\Controllers\FilmController@listFilm');
Route::post('/home/films-list','App\Http\Controllers\FilmController@listFilm');
Route::post('/home/films-rent','App\Http\Controllers\FilmController@rentFilm');
Route::post('/return-films','App\Http\Controllers\FilmController@returnFilm');
Route::post('/rented-films/list','App\Http\Controllers\FilmController@listFilmRent');
