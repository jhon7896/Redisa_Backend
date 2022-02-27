<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuario = UserProfile::find(auth()->user()->user_id);
        return view('usuarios.perfil')->with(compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        if($request->user_password != NULL){
            $request->merge([
                'user_password' => Hash::make($request->input('user_password'))
            ]);
            User::findOrFail($id)->update($request->all());
        }

        $usuario = User::findOrFail($id);
        $usuario->user_name = $request->user_name;
        $usuario->save();

        $usuario_perfil = UserProfile::findOrFail($id);
        $usuario_perfil->upro_email = $request->upro_email;
        $usuario_perfil->upro_firstName = $request->upro_firstName;
        $usuario_perfil->upro_lastName = $request->upro_lastName;
        $usuario_perfil->upro_address = $request->upro_address;
        $usuario_perfil->upro_city = $request->upro_city;
        $usuario_perfil->upro_country = $request->upro_country;
        $usuario_perfil->upro_postalCode = $request->upro_postalCode;
        $usuario_perfil->upro_aboutMe = $request->upro_aboutMe;
        $usuario_perfil->save();


        $respuesta = [];
        $respuesta["error"] = false;
        $respuesta["mensaje"] = "Perfil de Usuario actualizado con exito!!!.";
        $respuesta["aboutme"] = $usuario_perfil->upro_aboutMe;

        if ($request->hasFile('upro_image'))
        {
            $user = UserProfile::findOrFail($id);
            $file = $request->file('upro_image');
            $destinationPath = 'img/fotoperfil/';
            $filename = time(). '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('upro_image')->move($destinationPath, $filename);
            $user->upro_image = '/'.$destinationPath.$filename;
            $user->save();
            $respuesta["photo"] = $user->upro_image;

        }else{
            $respuesta["photo"] = $usuario_perfil->upro_image;
        }




        return \Response::json($respuesta);
    }
}
