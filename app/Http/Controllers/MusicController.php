<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\campaign;
use App\Models\Carton;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Support\Facades\Route;

class MusicController extends Controller
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

        //relacion de clientes
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();

        $empresa_current = User::Where('id', $user_current->parent_id)->first();

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

        //relacion de campañas por cliente
        $cartones_count = DB::table('campaigns')
            ->join('campaign_user', 'campaigns.id', '=', 'campaign_user.campaign_id')
            ->join('users', 'campaign_user.user_id', '=', 'users.id')
            ->join('cartons', 'campaigns.id', '=', 'cartons.campaign_id')
            //->select('campaigns.*', 'users.name as nombre_cliente')
            ->select(DB::raw('count(cartons.campaign_id) as user_count'))
            ->get();

        //dd($cartones_count);

        $campania = DB::table('users')
            ->where('users.id', '=', $user_current->user_id)
            ->join('campaigns', 'users.campania_id', '=', 'campaigns.id')
            ->first();

        //revisamos si tiene este usuario carton o no
        $carton = DB::table('cartons')
                ->where('cartons.user_id','=', $user_current->user_id)
                ->first();

        $cartones = DB::table('cartons')->get();

        $musics = Music::all();

        return view('admin.music.index', compact('users', 'campanias', 'user_current', 'empresa_current', 'trabajadores', 'campania', 'carton', 'cartones', 'musics'));
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
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        //
        //
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();

        $id_auth = auth()->user()->id;
        $user_current = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('users.id', '=', $id_auth)
            ->first();

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


        $cartones = DB::table('cartons')->get();

        return view('admin.music.edit', compact('users', 'user_current', 'trabajadores', 'campanias', 'cartones', 'music'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music $music)
    {
        //
        $music->name = $request->name;
        $music->order = $request->order;
        $music->update();

        return redirect('/admin/music');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $music = Music::find($id);
        $nombre = $music->name;
        $music->delete();

        return $nombre;

    }
}
