<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\UserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use DataTables;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $sub_categories = DB::table('sub_categories as sb')
                ->join('categories as c', 'sb.cate_id', 'c.cate_id')
                ->select('sb.subc_id', 'sb.subc_description', 'sb.subc_state', 'c.cate_description')
                ->where('subc_state', '1')
                ->get();
            return DataTables::of($sub_categories)
                ->addColumn('action', function($sub_categories){
                    $acciones = '<a href="javascript:void(0)" onclick="editSubCategory('.$sub_categories->subc_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$sub_categories->subc_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $usuario = UserProfile::find(auth()->user()->user_id);
        $categories = DB::table('categories')->where('cate_state', '1')->get();
        return view('products.subcategory', compact('usuario', 'categories'));
    }

    public function store(Request $request)
    {
        if (SubCategory::all()->count()) {
            $last_subc_id = SubCategory::all()->last()->subc_id+1;
        } else {
            $last_subc_id = 1;
        }

        DB::table('sub_categories')->insert([
            'subc_id' => $last_subc_id,
            'subc_description' => $request->subc_description,
            'subc_state' => '1',
            'cate_id' => $request->cate_id
        ]);

        return back();
    }

    public function edit($id)
    {
        $sub_categories = DB::table('sub_categories')->where('subc_id', $id)->get();
        return response()->json($sub_categories);
    }

    public function actualizar(Request $request)
    {
        DB::table('sub_categories')->where('subc_id', $request->subc_id)->update([
            'subc_description' => $request->subc_description,
            'subc_state' => '1',
            'cate_id' => $request->cate_id
        ]);
        return back();
    }

    public function eliminar($id)
    {
        DB::table('sub_categories')->where('subc_id', $id)->delete();
        DB::table('sub_categories')->where('subc_id', '>', $id)->decrement('subc_id', 1);
        return back();
    }
}
