<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/','welcome');
Route::view('/rented-films','rentedFilms');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/films','App\Http\Controllers\FilmController@listFilm');
Route::post('/home/films-rent','App\Http\Controllers\FilmController@rentFilm');
Route::post('/return-films','App\Http\Controllers\FilmController@returnFilm');
Route::post('/rented-films/list','App\Http\Controllers\FilmController@listFilmRent');
