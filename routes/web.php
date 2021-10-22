<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('dashboard');
    return view('inicio');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/registro', [App\Http\Controllers\ClientController::class, 'register'])->name('registrotrabajador');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('admin/clientes', [App\Http\Controllers\ClientController::class, 'index'])->name('admin.clients.index');
	Route::get('admin/clientes/crear', [App\Http\Controllers\ClientController::class, 'create'])->name('admin.clients.create');
	Route::get('admin/clientes/{id}/editar', [App\Http\Controllers\ClientController::class, 'edit'])->name('admin.clients.edit');
	Route::post('admin/clientes/registrar', [App\Http\Controllers\ClientController::class, 'store'])->name('admin.clients.store');
	Route::post('admin/clientes/registrarjuego', [App\Http\Controllers\ClientController::class, 'storegame'])->name('admin.clients.storegame');
	Route::get('admin/clientes/{id}/crearjuego', [App\Http\Controllers\ClientController::class, 'creategame'])->name('admin.clients.creategame');
	Route::get('admin/clientes/{id}/listarjuegos', [App\Http\Controllers\ClientController::class, 'show'])->name('admin.clients.show');
	Route::put('admin/clientes/{id}/actualizar', [App\Http\Controllers\ClientController::class, 'update'])->name('admin.clients.update');
	Route::put('admin/clientes/{id}/actualizarjuego', [App\Http\Controllers\ClientController::class, 'updategame'])->name('admin.clients.updategame');
	Route::get('admin/clientes/{id}/editarjuego', [App\Http\Controllers\ClientController::class, 'editgame'])->name('admin.clients.editgame');

	//cartones de bingo
	//Route::get('admin/clientes/{id}/crearcarton', [App\Http\Controllers\ClientController::class, 'createbingo'])->name('admin.clients.createbingo');

	Route::post('admin/clientes/crearcarton', [App\Http\Controllers\ClientController::class, 'createbingo'])->name('admin.clients.createbingo');

	Route::delete('admin/clientes/borrarcamp', [App\Http\Controllers\ClientController::class, 'borrarcamp'])->name('admin.clients.borrarcamp');

	Route::delete('admin/usuarios/borrarusuarios', [App\Http\Controllers\ClientController::class, 'borraruser'])->name('admin.user.borraruser');

	Route::post('admin/clientes/consultarcamp', [App\Http\Controllers\ClientController::class, 'consultarcamp'])->name('admin.clients.consultarcamp');

	Route::post('admin/clientes/ver', [App\Http\Controllers\ClientController::class, 'vercarton'])->name('admin.clients.vercarton');

	//rutas para listados de cartones y jugadas
	Route::get('admin/games', [App\Http\Controllers\GameController::class, 'index'])->name('admin.games.index');

});

