<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class FilmController extends Controller
{
    //Función que devuelve un listado de peliculas.
    public function listFilm(Request $request) : JsonResponse
    {
        $query = DB::table('film')->select('name');
        $film = $query->get()->toArray();
        return response()->json($film,200);

    }
}
