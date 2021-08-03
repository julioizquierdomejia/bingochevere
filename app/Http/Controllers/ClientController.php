<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidationformRequest;
use App\Http\Requests\ValidationFormRequest_creargame;

use App\Models\User;
use App\Models\campaign;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

class ClientController extends Controller
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


        return view('admin.clients.index', compact('users', 'campanias', 'user_current', 'empresa_current', 'trabajadores', 'campania'));
    }

    public function createbingo($id)
    {
        
        //rangos
        $b_range = range(1, 15);
        $i_range = range(16, 30);
        $n_range = range(31, 45);
        $g_range = range(46, 60);
        $o_range = range(61, 75);

        $range = [];

        foreach (range(0, 15 - 1) as $i) {
            while(in_array($num = mt_Rand(1, 15), $range));
            $range[] = $num;
        }
        dd($range);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();

        $id = auth()->user()->id;
        $user_current = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('users.id', '=', $id)
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

        return view('admin.clients.create', compact('users', 'user_current', 'trabajadores', 'campanias'));
    }

    public function register(ValidationformRequest $request)
    {
        $datos = explode('-', $request['url']);

        /*
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'parent_id' => $datos[0],
            'campania_id' => $datos[1],
            'status' => 1,
        ]);
        */

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->parent_id = $datos[0];
        $user->campania_id = $datos[1];
        $user->password = bcrypt($request['password']);
        $user->status = 1;

        $user->save();

        $user->roles()->attach(3);

        return redirect('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationformRequest $request)
    {
        //
        //ruta del storage para las imagenes
        //$ruta = storage_path() . '/logos_clientes/';
        $nombre_imagen_logo = '';
        $ruta = 'assets/img/logos_clientes/';

        if ($request->hasFile('logo_cliente')) { // el fondo del diseño
            $nombre_imagen_logo =  time()."_".request()->file('logo_cliente')->getClientOriginalName();//Aqui se genera el nombre de la imagen
        
            //Capturamos la imagen que viene por el fomrulario
            $imagen = request()->file('logo_cliente');
        
            //grabamos la imagen en el storage public
            Image::make($imagen)->save($ruta.$nombre_imagen_logo, 60);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->parent_id = 1;
        $user->nombre_comercial = $request->nombre_comercial;
        $user->ruc = $request->ruc;
        $user->contacto = $request->contacto;
        $user->area = $request->area;
        $user->telefono = $request->telefono;
        $user->password = bcrypt('12345678');

        $user->logo_cliente = $nombre_imagen_logo;

        $user->status = 1;

        $user->save();

        /*
        //selccionamos el ultimo usuario creado y guardamos su ID
        $usuario_new = User::all()->where('id', $user->id);

        //creamos la URL para el registro de colaboradores
        $ruta_register = $request->root().'/register?='.$user->id;

        //Actualizamos el ultimo usuario creado para tener su url de registro 
        $user->url_register = $ruta_register;
        $user->save();
        */

        $user->roles()->attach(2);

        $users = User::all()->where('id', 2);
        
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();

        //return view('admin.clients.index', compact('users', 'campanias'));
        return redirect('admin/clientes');

    }

    
    public function storegame(ValidationFormRequest_creargame $request)
    {

        //ruta del storage para las imagenes
        //$ruta = storage_path() . '/background_bingo/';
        $ruta = 'assets/img/background_bingo/';
        $nombre_imagen_disenio = '';
        $nombre_imagen = '';

        if ($request->hasFile('background_design')) { // el fondo del diseño
            $nombre_imagen_disenio =  time()."_".request()->file('background_design')->getClientOriginalName();//Aqui se genera el nombre de la imagen
        
            //Capturamos la imagen que viene por el fomrulario
            $imagen = request()->file('background_design');
        
            //grabamos la imagen en el storage public
            Image::make($imagen)->save($ruta.$nombre_imagen_disenio, 80);
        }

        if ($request->hasFile('logo_central')) { //el logo para el carton del bingo
            $nombre_imagen =  time()."_".request()->file('logo_central')->getClientOriginalName();//Aqui se genera el nombre de la imagen
        
            //Capturamos la imagen que viene por el fomrulario
            $imagen = request()->file('logo_central');
        
            //grabamos la imagen en el storage public
            Image::make($imagen)->save($ruta.$nombre_imagen, 80);
        }

        $campania = new campaign();
        $campania->name = $request->name;
        $campania->description = $request->description;
        $campania->background_design = $nombre_imagen_disenio;
        $campania->logo_central = $nombre_imagen;
        $campania->status = $request->statusCamapania;
        $campania->cant = $request->cant;
        $campania->color = $request->color;
        //$campania->url_register = $ruta_register;
        $campania->save();

        //creamos la URL para el registro de colaboradores
        $ruta_register = $request->root().'/register?valores='.$request->id.'-'.$campania->id;
        $campania->url_register = $ruta_register;
        $campania->save();

        $campania->users()->attach($request->id);

        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();
        
        return redirect('admin/clientes');

    }


    public function creategame($id)
    {
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

        $user = User::all()->where('id', $id)->first();

        return view('admin.clients.creategame', compact('users', 'user', 'user_current', 'trabajadores', 'campanias'));

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
        $juegos = DB::table('campaigns')
            ->join('campaign_user', 'campaigns.id', 'campaign_user.campaign_id')
            ->where('campaign_user.user_id', '=', $id)
            ->get();

        return $juegos;
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

        $user = User::where('id', $id)->first();

        return view('admin.clients.edit', compact('user', 'users', 'user_current', 'trabajadores', 'campanias'));
        
    }

    public function editgame($id)
    {
        //
        $id = auth()->user()->id;
        $user_current = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('users.id', '=', $id)
            ->first();

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

        $campania = campaign::where('id', $id)->first();

        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();

        return view('admin.clients.editgame', compact('campania', 'users', 'user_current', 'empresa_current', 'trabajadores', 'campanias'));
        
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
        //relacion de clientes
        $users = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('role_user.role_id', '=', 2)
            ->get();

        $user = User::where('id', $id)->first();

        $id_current = auth()->user()->id;
        $user_current = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->where('users.id', '=', $id_current)
            ->first();

        //creamos la URL para el registro de colaboradores
        $ruta_register = $request->root().'/register?='.$user->id;
        
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'nombre_comercial' => $request->input('nombre_comercial'),
            'ruc' => $request->input('ruc'),
            'email' => $request->input('email'),
            'contacto' => $request->input('contacto'),
            'area' => $request->input('area'),
            'telefono' => $request->input('telefono'),
            //'url_register' => $ruta_register,
        ]);

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

        $empresa_current = User::Where('id', $user_current->parent_id)->first();

        //return redirect()->back();
        return view('admin.clients.index', compact('users', 'campanias', 'user_current', 'empresa_current', 'trabajadores'));

    }

    public function updategame(Request $request, $id)
    {
        //
        $campania = campaign::where('id', $id)->first();
        
        $campania->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            //'background_design' => $request->input('background_design'),
            'cant' => $request->input('cant'),
            'color' => $request->input('color'),
            'status' => $request->input('statusCamapania'),
        ]);



        return redirect()->back();

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
