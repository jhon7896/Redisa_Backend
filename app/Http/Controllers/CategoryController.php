<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $categories = DB::table('categories')->where('cate_state', '1')->get();
            return DataTables::of($categories)
                ->addColumn('action', function($categories){
                    $acciones = '<a href="javascript:void(0)" onclick="editCategory('.$categories->cate_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$categories->cate_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $usuario = UserProfile::find(auth()->user()->user_id);
        return view('products.category', compact('usuario'));
    }

    public function store(Request $request)
    {
        if (Category::all()->count()) {
            $last_cate_id = Category::all()->last()->cate_id+1;
        } else {
            $last_cate_id = 1;
        }

        DB::table('categories')->insert([
            'cate_id' => $last_cate_id,
            'cate_description' => $request->cate_description,
            'cate_state' => '1'
        ]);

        return back();
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->where('cate_id', $id)->get();
        return response()->json($categories);
    }

    public function actualizar(Request $request)
    {
        DB::table('categories')->where('cate_id', $request->cate_id)->update([
            'cate_description' => $request->cate_description,
            'cate_state' => '1'
        ]);
        return back();
    }

    public function eliminar($id)
    {
        DB::table('categories')->where('cate_id', $id)->delete();
        DB::table('categories')->where('cate_id', '>', $id)->decrement('cate_id', 1);
        return back();
    }
}
