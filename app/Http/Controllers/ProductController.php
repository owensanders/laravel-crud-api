<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function create(Request $request): Response
    {
        $this->validate($request, [
            'name'        => 'required|string',
            'slug'        => 'required|string',
            'description' => 'string',
            'price'       => 'required'
        ]);

        Product::create([
            'name'        => $request->name,
            'slug'        => $request->slug,
            'description' => $request->description,
            'price'       => $request->price
        ]);

        return response([
            'message' => 'Product Created Successfully!'
        ], 201);
    }

    public function show(int $id): Response
    {
        return Product::find($id);
    }

    public function update(Request $request, int $id): Response
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response([
            'output'  => $product,
            'message' => 'Product Updated Successfully!'
        ], 200);
    }

    public function destroy(int $id): Response
    {
        Product::destroy($id);

        return response([
            'message' => 'Product Successfully Deleted!'
        ], 200);
    }

    public function search(string $name): Response
    {
        $product = Product::where('name', 'like', "%$name%")->get();

        return response([
            'message' => 'Product Found!',
            'output'  => $product
        ], 200);
    }
}
