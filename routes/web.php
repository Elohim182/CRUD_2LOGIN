<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

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
/*
if (Auth::check())
{
    return view('usuario.perfil');
}
else
    return view('usuario.login');
*/

Route::get('/', function () {
    return view('usuario.login');
});

Route::group(['middleware' => 'maestro'], function () {
    Route::post('/registro/{tipo}',[UsuarioController::class,'registro']);
    Route::get('registro_usuario', function () {
    return view('usuario.registro');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/perfil/{id}',[UsuarioController::class,'perfil']);
    Route::get('/logout',[UsuarioController::class,'logout']);
    Route::post('/update/{id}',[UsuarioController::class,'update']);
});
Route::post('/login',[UsuarioController::class,'login']);

//Route::get('/registro',[UsuarioController::class,'showregistro'])->middleware('auth');

