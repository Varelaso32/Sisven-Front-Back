<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{

    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();

        return json_encode(['products' => $products]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:100', 'unique:products,name'],
            'precio' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ], 400);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->precio = $request->precio;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json(['product' => $product]);
    }

    public function show($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('products.id', $id)
            ->first();

        if (is_null($product)) {
            return response()->json(['msg' => 'Producto no encontrado.'], 404);
        }

        return response()->json(['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'max:100', 'unique:products,name,' . $id],
            'precio' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'Se produjo un error en la validación de la información.',
                'errors' => $validate->errors(),
                'statusCode' => 400
            ], 400);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['msg' => 'Producto no encontrado.'], 404);
        }

        $product->name = $request->name;
        $product->precio = $request->precio;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json(['product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['msg' => 'Producto no encontrado.'], 404);
        }

        $product->delete();

        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();

        return response()->json(['products' => $products]);
    }
}
