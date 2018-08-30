<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CategoryAPIController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json(CategoryResource::collection($categories), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'title' => 'required|unique:title,categories'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

}
