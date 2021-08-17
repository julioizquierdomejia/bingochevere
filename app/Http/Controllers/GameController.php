<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationformRequest;
use App\Http\Requests\ValidationFormRequest_creargame;

use App\Models\User;
use App\Models\campaign;
use App\Models\Carton;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

use File;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = auth()->user()->id;
        $user_current = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('users.id', '=', $id)
            ->first();

        $empresa_current = User::Where('id', $user_current->parent_id)->first();

        //relacion de clientes
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();

        //Relacion de trabajdores tipo 3
        $trabajadores = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 3)
            ->get();

        //relacion de campañas por cliente
        $campanias = DB::table('campaigns')
            ->join('campaign_user', 'campaigns.id', '=', 'campaign_user.campaign_id')
            ->join('users', 'campaign_user.user_id', '=', 'users.id')
            ->select('campaigns.*', 'users.name as nombre_cliente')
            ->get();

        $campania = DB::table('users')
            ->where('users.id', '=', $user_current->id)
            ->join('campaigns', 'users.campania_id', '=', 'campaigns.id')
            ->first();

        //revisamos si tiene este usuario carton o no
        $carton = DB::table('cartons')
                ->where('cartons.user_id','=', $user_current->id)
                ->first();

        $cartones = DB::table('cartons')
                ->join('users', 'cartons.user_id', '=', 'users.id')
                ->join('campaigns', 'cartons.campaign_id', '=', 'campaigns.id')
                ->select('users.*', 'cartons.*', 'campaigns.name as nombre_camapnia')
                ->get();

        return view('admin.games.index', compact('users', 'campanias', 'user_current', 'empresa_current', 'trabajadores', 'campania', 'carton', 'cartones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
