<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;

class RegisterController extends Controller
{
    public function index()
    {
        $roles = Role::where('role_state', '1')->get();
        return view('usuarios.registro', compact('roles'));
    }

    public function registrar(Request $request)
    {
        request()->validate([
            'user_name' => ['required', 'string', 'max:255', 'unique:users'],
            'user_password' => ['required', 'string', 'max:255', 'min:8'],
        ],
        [
            'user_name.required'=>'Ingrese usuario',
            'user_name.max'=>'Maximo 20 caracteres para el username del usuario',
            'user_name.unique'=>'Usuario ya registrado',
            'user_password.required'=>'Ingrese contraseña ',
            'user_password.max'=>'Maximo 20 caracteres permitidos',
            'user_password.min'=>'Mínimo 8 caracteres permitidos',

        ]);

        if (User::all()->count()) {
            $last_user_id = User::all()->last()->user_id+1;
        } else {
            $last_user_id = 1;
        }
        $nuevo_usuario = new User();
        $nuevo_usuario->user_id = $last_user_id;
        $nuevo_usuario->user_name = $request->user_name;
        $nuevo_usuario->user_password = Hash::make($request->input('user_password'));
        $nuevo_usuario->user_state = '1';
        $nuevo_usuario->role_id = $request->role_id;
        $nuevo_usuario->save();

        if (UserProfile::all()->count()) {
            $last_upro_id = UserProfile::all()->last()->upro_id+1;
        } else {
            $last_upro_id = 1;
        }

        $nuevo_perfil_usuario = new UserProfile();
        $nuevo_perfil_usuario->upro_id = $last_upro_id;
        $nuevo_perfil_usuario->user_id = $last_user_id;
        $nuevo_perfil_usuario->save();

        return \Response::json([
            "mensaje" => "Usuario creado satisfactoriamente",
            "usuario" => $nuevo_usuario
        ]);

    }
}
