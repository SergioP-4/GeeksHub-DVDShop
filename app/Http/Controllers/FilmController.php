<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Models\Film;

class FilmController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-film|crear-film|editar-film|borrar-film', ['only' =>['index']]);
        $this->middleware('permission:crear-film', ['only' =>['create','store']]);
        $this->middleware('permission:editar-film', ['only' =>['edit','upadate']]);
        $this->middleware('permission:borrar-film', ['only' =>['destroy']]);
    }

    public function index(){
        $films = Film::paginate(100);
        return view('films.index',compact('films'));
    }

    public function create(){
        return view('films.crear');
    }

    public function store(Request $request){
        request()->validate([
            'name' => 'required'
                            ]);
        Film::create($request->all());
        return redirect()->route('films.index');
    }

    public function show($id){

    }

    public function edit(Film $film){
        return view('films.editar',compact('film'));
    }

    public function update(Request $request, Film $film){
        request()->validate([
            'name' => 'required'
                            ]);
        $film->update($request->all());
        return redirect()->route('films.index');
    }

    public function destroy(Film $film){
        $film->delete();
        return redirect()->route('films.index');
    }
    //Función que devuelve un listado de peliculas.
    public function listFilm() : JsonResponse{

        $filmlist = DB::table('films')
            ->select('films.name','films.id')
            ->whereNotIn('films.id', function($subQuery)
            {
                $user_id = Auth::id();
                $subQuery->select('film_id')
                    ->from('film_user')
                    ->where('active_flag','=',1)
                    ->where('film_user.user_id','=',$user_id);
            })->get()->toArray();

        return response()->json($filmlist,200);
    }

    //Función alquilar pelicula
    public function rentFilm(Request $request) : JsonResponse
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
    public function returnFilm (Request $request) : JsonResponse {
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
        $user_id = Auth::id();
        $query = DB::table('films')
            ->select('name','films.id')
            ->join('film_user',function($join) {
                $join->on('films.id','=','film_user.film_id')
                    ->where('film_user.active_flag','=',1);
            })->where('film_user.user_id','=',$user_id);
        $filmrent = $query->get()->toArray();

        return response()->json($filmrent,200);
    }
}

