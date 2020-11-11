<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStroeRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return Product::all();

    }

    public function store(ProductStroeRequest $request)
    {
        return Product::create($request->only('name','price'));
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    public function destroy($id)
    {
        Product::destroy($id);
    }
}
