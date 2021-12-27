<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class FilmController extends Controller
{
    //Función que devuelve un listado de peliculas.
    public function listFilm() : JsonResponse {
        $query = DB::table('film')
            ->select('film.name','film.id')
            ->whereNotIn('film.id', function($subQuery)
            {
                $subQuery->select('film_id')
                    ->from('film_user')
                    ->where('active_flag','=',1);
            });

        $film = $query->get()->toArray();

        return response()->json($film,200);
    }

    //Función alquilar pelicula
    public function rentFilm(Request $request) /*: JsonResponse*/
    {
        $user_id = Auth::id();
        $film_id = $request->film_id;
        if (!is_null($film_id)) {
            $insert = DB::table('film_user')->insert(
                [
                    'user_id' => $user_id,
                    'film_id' => $film_id,
                    'active_flag' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            return response()->json($insert,200);
        }
    }

    //Función devolver pelicula
    public function returnFilm (Request $request) /*: JsonResponse*/ {
        $user_id = Auth::id();
        $film_id = $request->film_return_id;
        if(!is_null($film_id)){
            $affected = DB::table('film_user')
                ->where('user_id','=',$user_id)
                ->where('film_id','=',$film_id)
                ->update(['active_flag' => 0]);
            return response()->json($affected,200);
        }
    }

    public function listFilmRent() : JsonResponse {
        $query = DB::table('film')
            ->select('name','film.id')
            ->join('film_user',function($join) {
                $join->on('film.id','=','film_user.film_id')
                    ->where('film_user.active_flag','=',1);
            });
        $film = $query->get()->toArray();

        return response()->json($film,200);
    }
}

