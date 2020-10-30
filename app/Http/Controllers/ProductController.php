<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::query()
            ->latest('updated_at')
            ->paginate(10);

        return view(
            'products.index',
            [
                'products' => $products
            ]
        );
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        return view('products.form');
    }

    public function store(ProductFormRequest $request)
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();
        /** @var User $user */
        $user = auth()->user();

        $product = $user->products()
            ->create($data);

        return redirect()->route('products.show', $product);
    }

    public function show(Product $product)
    {
        return view(
            'products.show',
            [
                'product' => $product
            ]
        );
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view(
            'products.form',
            [
                'product' => $product
            ]
        );
    }


    public function update(ProductFormRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->validated();
        $product->update($data);

        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
        return redirect()->route('products.index');
    }
}
