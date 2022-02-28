<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $users = DB::table('users as u')
                        ->join('user_profiles as up', 'u.user_id', 'up.user_id')
                        ->join('roles as r', 'u.role_id', 'r.role_id')
                        ->where('u.user_state', '1')
                        ->select(DB::raw("CONCAT(up.upro_firstName, ' ',up.upro_lastName) AS upro_fullName, u.user_id, u.user_name, up.upro_email, r.role_description"))
                        ->get();
            return DataTables::of($users)
                ->addColumn('action', function($users){
                    $acciones = '<a href="javascript:void(0)" onclick="editUser('.$users->user_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$users->user_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $usuario = UserProfile::find(auth()->user()->user_id);
        $roles = Role::where('role_state', '1')->get();
        return view('usuarios.index', compact('usuario', 'roles'));
    }

    public function store(Request $request)
    {
        if (User::all()->count()) {
            $last_user_id = User::all()->last()->user_id+1;
        } else {
            $last_role_id = 1;
        }

        if (UserProfile::all()->count()) {
            $last_upro_id = UserProfile::all()->last()->upro_id+1;
        } else {
            $last_upro_id = 1;
        }

        DB::table('users')->insert([
            'user_id' => $last_user_id,
            'user_name' => $request->user_name,
            'user_password' => Hash::make($request->input('user_password')),
            'user_state' => '1',
            'role_id' => $request->role_id
        ]);

        DB::table('user_profiles')->insert([
            'upro_id' => $last_user_id,
            'user_id' => $last_user_id
        ]);

        return back();
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('user_id', $id)->get();
        return response()->json($user);
    }

    public function actualizar(Request $request)
    {
        $usuario = User::findOrFail($request->user_id);

        if($request->user_password !=null){
            $request->merge([
                'user_password' => Hash::make($request->input('user_password'))
            ]);

            User::findOrFail($request->user_id)->update($request->all());
        }


        DB::table('users')->where('user_id', $request->user_id)->update([
            'user_name' => $request->user_name,
            'role_id' => $request->role_id
        ]);

        return back();
    }

    public function eliminar($id)
    {

        DB::table('users')->where('user_id', $id)->delete();
        DB::table('users')->where('user_id', '>', $id)->decrement('user_id', 1);
        DB::table('user_profiles')->where('upro_id', '>', $id)->decrement('upro_id', 1);
        return back();
    }
}
