<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\UserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $roles = DB::table('roles')->where('role_state', '1')->get();
            return DataTables::of($roles)
                ->addColumn('action', function($roles){
                    $acciones = '<a href="javascript:void(0)" onclick="editRole('.$roles->role_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$roles->role_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $usuario = UserProfile::find(auth()->user()->user_id);
        return view('roles.index', compact('usuario'));
    }

    public function store(Request $request)
    {
        if (Role::all()->count()) {
            $last_role_id = Role::all()->last()->role_id+1;
        } else {
            $last_role_id = 1;
        }

        DB::table('roles')->insert([
            'role_id' => $last_role_id,
            'role_description' => $request->role_description,
            'role_abbreviation' => $request->role_abbreviation,
            'role_state' => '1'
        ]);
        return back();
    }

    public function edit($id)
    {
        $rol = DB::table('roles')->where('role_id', $id)->get();
        return response()->json($rol);
    }

    public function actualizar(Request $request)
    {
        DB::table('roles')->where('role_id', $request->role_id)->update([
            'role_description' => $request->role_description,
            'role_abbreviation' => $request->role_abbreviation,
            'role_state' => '1'
        ]);
        return back();
    }

    public function eliminar($id)
    {
        DB::table('roles')->where('role_id', $id)->delete();
        DB::table('roles')->where('role_id', '>', $id)->decrement('role_id', 1);
        return back();
    }
}
