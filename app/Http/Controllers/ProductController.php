<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
//use Illuminate\Http\Request;
//use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = auth()->user()
            ->products()
            ->latest()
            ->with('category')
            ->where(function ($query) {
                if ($search = request()->search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                }
            })
            ->paginate(10)
            ->withQueryString();

        return inertia('Product/Index', [
            'products' => ProductResource::collection($products),
            'query' => (object) request()->query()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Product/Create', [
            'categories' => CategoryResource::collection(Category::orderBy('name')->get())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $request->user()->products()->create($request->validated());

        return redirect()
            ->route('products.index')
            ->with('message', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return inertia('Product/Show', [
            'product' => ProductResource::make($product)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return inertia('Product/Edit', [
            'categories' => CategoryResource::collection(Category::orderBy('name')->get()),
            'product' => ProductResource::make($product)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with('message', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('message', 'Product deleted successfully');
    }
}
