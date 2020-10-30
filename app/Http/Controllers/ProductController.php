<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::query()
            ->latest('updated_at')
            ->get();

        return view(
            'products.index',
            [
                'products' => $products
            ]
        );
    }

    public function create()
    {
        return view('products.form');
    }

    public function store(ProductFormRequest $request)
    {
        $data = $request->validated();
        $product = Product::query()
            ->create($data);

        return redirect()->route('products.show', $product);
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.form', [
            'product' => $product
        ]);
    }


    public function update(ProductFormRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
