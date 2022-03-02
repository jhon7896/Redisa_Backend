<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $products = DB::table('products as p')
                ->join('sub_categories as sb', 'p.subc_id', 'sb.subc_id')
                ->join('categories as c', 'sb.cate_id', 'c.cate_id')
                ->select('p.prod_id', 'p.prod_code', 'p.prod_name', 'p.prod_description', 'p.prod_price', 'p.prod_stock', 'p.prod_state', 'c.cate_description','sb.subc_description')
                ->where('prod_state', '1')
                ->get();
            return DataTables::of($products)
                ->addColumn('action', function($products){
                    $acciones = '<a href="javascript:void(0)" onclick="editProduct('.$products->prod_id.')" class="btn btn-info btn-sm"> Editar </a>';
                    $acciones .= '&nbsp;&nbsp;<button type="button" name="delete" id="'.$products->prod_id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
                    return $acciones;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $usuario = UserProfile::find(auth()->user()->user_id);
        $categories = DB::table('categories')->where('cate_state', '1')->get();
        $sub_categories = DB::table('sub_categories')->where('subc_state', '1')->get();
        return view('products.product', compact('usuario', 'categories', 'sub_categories'));
    }

    public function store(Request $request)
    {
        if (Product::all()->count()) {
            $last_prod_id = Product::all()->last()->prod_id+1;
        } else {
            $last_prod_id = 1;
        }

        DB::table('products')->insert([
            'prod_id' => $last_prod_id,
            'prod_code' => $request->prod_code,
            'prod_name' => $request->prod_name,
            'prod_description' => $request->prod_description,
            'prod_price' => $request->prod_price,
            'prod_stock' => $request->prod_stock,
            'subc_id' => $request->subc_id,
        ]);

        return back();
    }

    public function edit($id)
    {
        $products = DB::table('products as p')
                ->join('sub_categories as sb', 'p.subc_id', 'sb.subc_id')
                ->join('categories as c', 'sb.cate_id', 'c.cate_id')
                ->select('p.prod_id', 'p.prod_code', 'p.prod_name', 'p.prod_description', 'p.prod_price', 'p.prod_stock', 'p.prod_state', 'c.cate_id', 'sb.subc_id')
                ->where('prod_state', '1')
                ->where('prod_id', $id)
                ->get();
        return response()->json($products);
    }

    public function actualizar(Request $request)
    {
        DB::table('products')->where('prod_id', $request->prod_id)->update([
            'prod_id' => $request->prod_id,
            'prod_code' => $request->prod_code,
            'prod_name' => $request->prod_name,
            'prod_description' => $request->prod_description,
            'prod_price' => $request->prod_price,
            'prod_stock' => $request->prod_stock,
            'subc_id' => $request->subc_id,
        ]);
        return back();
    }

    public function eliminar($id)
    {
        DB::table('products')->where('prod_id', $id)->delete();
        DB::table('products')->where('prod_id', '>', $id)->decrement('prod_id', 1);
        return back();
    }
}
