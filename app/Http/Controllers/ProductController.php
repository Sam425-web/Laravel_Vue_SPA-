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
        return Product::orderBy('id', 'desc')->get();

    }

    public function store(ProductStroeRequest $request)
    {
        return Product::create($request->only('name','price'));
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->all());
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }
}
