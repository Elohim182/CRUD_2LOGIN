<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
        {
            return redirect('registro_usuario')->with('Sesion iniciada');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/')->with('Sesion cerrada');
    }
    public function registro(Request $request)
    {
        //dd($request->tipo);
        //dd(auth()->user()->nombre);
        $campos=[
            'nombre'=>'required|string|max:100',
            'email'=>'required|email',
            'password'=>'required|string|max:100|min:8',
        ];
        $mensaje=[
            'required'=>'El :attributo es requerido'
        ];

        $this->validate($request,$campos,$mensaje);

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo_usuario' => $request->tipo,
        ]);

        return redirect('registro_usuario')->with('mensaje','Usuario agregado');
        //return redirect('usuario')->with('mensaje','Usuario agregado con exito');  
    }
    public function perfil(Request $request)
    {
        $usuario=User::findOrFail($request->id);
        //dd(compact('usuario'));
        return view('usuario.perfil',compact('usuario'));
    }
    public function update(Request $request)
    {
        if($request->password!="")
        {
           $campos=[
                'nombre'=>'required|string|max:100',
                'email'=>'required|email',
                'password_nuevo' => 'min:8'
            ];
            $mensaje=[
                'required'=>'El :attributo es requerido',
                'min' => 'La contraseña debe contener minimo 8 caracteres'
            ]; 
        }
        else
        {
            $campos=[
                'nombre'=>'required|string|max:100',
                'email'=>'required|email'
            ];
            $mensaje=[
                'required'=>'El :attributo es requerido'
            ];
        }

        $mensaje2=[
                'fallo'=>'El :error en la operacion'
            ];

        $this->validate($request,$campos,$mensaje);
        $usuario=User::findOrFail($request->id);

        User::where('id','=',$request->id)->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
        ]);

        //dd($request->password, $usuario->password);
        if(Hash::check($request->password, $usuario->password))
        {
            User::where('id','=',$request->id)->update([
                'password' => Hash::make($request->password_nuevo)
            ]);
            dd($request->password_nuevo);
        }
        else
        {
            $mensaje2="La contraseña no coincide";
            return redirect('perfil/'.Auth::user()->id);
        }

        return redirect('perfil/'.Auth::user()->id);
    }
}
