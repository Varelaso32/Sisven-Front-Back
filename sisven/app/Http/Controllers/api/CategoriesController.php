<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = DB::table('categories')
            ->select('categories.*')
            ->get();

        return json_encode(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $category = new Categories();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return json_encode(['category' => $category]);
    }

    public function show($id)
    {
        $category = Categories::find($id);

        if (is_null($category)) {
            return response()->json([
                'msg' => 'Categoría no encontrada.',
                'statusCode' => 404
            ], 404);
        }

        return json_encode(['category' => $category]);
    }

    public function update(Request $request, string $id)
    {
        $category = Categories::find($id);

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return json_encode(['category' => $category]);
    }

    public function destroy(string $id)
    {
        //
    }
}
