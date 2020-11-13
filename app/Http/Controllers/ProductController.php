<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

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

        /** @var Product $product */
        $product = $user->products()
            ->create($data);

        $this->uploadImage($request, $product);

        return redirect()->route('products.show', $product);
    }

    protected function uploadImage(ProductFormRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');

            $product->deleteImage();

            $product->update(
                [
                    'image_path' => $path
                ]
            );
        }
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
        $this->uploadImage($request, $product);

        return redirect()->route('products.show', $product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->deleteImage();

        $product->delete();
        return redirect()->route('products.index');
    }

    public function downloadFile(Product $product)
    {
        return Storage::download($product->image_path, $product->model);
    }

}
