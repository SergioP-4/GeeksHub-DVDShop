<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:ver-user|crear-user|editar-user|borrar-user', ['only' =>['index']]);
        $this->middleware('permission:crear-user', ['only' =>['create','store']]);
        $this->middleware('permission:editar-user', ['only' =>['edit','upadate']]);
        $this->middleware('permission:borrar-user', ['only' =>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::paginate(100);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('users.crear',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.editar',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        User::find($id)->delete();
        return redirect()->route('users.index');
    }

    //Listado de ventas
    public function salesList() : JsonResponse {
        $query = DB::table('users')
            ->select('users.name','films.name as film','film_user.created_at')
            ->join('film_user', function ($join) {
                $join->on('users.id', '=', 'film_user.user_id')
                    ->where('film_user.active_flag','=',1);
            })->join('films', function ($join){
                $join->on('film_user.film_id','=','films.id');
            })->get()->toArray();
        return response()->json($query,200);
    }

    //Listado de devoluciones
    public function salesRentList() : JsonResponse {
        $query = DB::table('users')
            ->select('users.name','films.name as film','film_user.created_at')
            ->join('film_user', function ($join) {
                $join->on('users.id', '=', 'film_user.user_id')
                    ->where('film_user.active_flag','=',0);
            })->join('films', function ($join){
                $join->on('film_user.film_id','=','films.id');
            })->get()->toArray();
        return response()->json($query,200);
    }
}
