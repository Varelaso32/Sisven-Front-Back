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
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
