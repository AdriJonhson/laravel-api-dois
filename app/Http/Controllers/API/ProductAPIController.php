<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ProductAPIController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('active', 1)
            ->get();
        return response()->json(ProductResource::collection($products), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Product::rules());

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function listCategory($title)
    {
        $category = Category::where('title', $title)->get();

        $products = $category->products->title;

        return response()->json($products, 200);
    }

    public function disableProduct(Request $request)
    {
        $data_form       = $request->all();
        $product         = Product::find($data_form['product_id']);

        if(empty($product)){
            return response()->json(['message' => 'Produto não encontrado'], 400);
        }

        if($product->active == 0){
            return response()->json(['message' => 'Esse produto já está desabilitado'], 400);
        }

        $product->active = 0;
        $product->save();

        return response()->json(['message' => 'Produto desabilitado com sucesso', 'data' => $product], 201);
    }

    public function listDisableProducts()
    {
        $products = Product::with('category')
            ->where('active', 0)
            ->get();
        return response()->json(ProductResource::collection($products), 200);

    }

    public function enableProduct(Request $request)
    {
        $data_form       = $request->all();
        $product         = Product::find($data_form['product_id']);

        if(empty($product)){
            return response()->json(['message' => 'Produto não encontrado'], 400);
        }

        if($product->active == 1){
            return response()->json(['message' => 'Esse produto já está abilitado'], 400);
        }


        $product->active = 1;
        $product->save();

        return response()->json(['message' => 'Produto abilitado com sucesso', 'data' => $product], 201);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(empty($product)){
            return response()->json(['message' => 'Produto não encontrado'], 400);
        }

        $product->delete();

        return response()->json(['message' => 'Produto removido com sucesso'], 200);
    }
    
}
