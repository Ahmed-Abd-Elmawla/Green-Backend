<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Traits\ShowToast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\ProductRequest;
use App\Http\Resources\Dashboard\Products\ProductResource;
use App\Http\Requests\Dashboard\Products\ProductUpdateRequest;

class ProductsController extends Controller
{
    use ShowToast;

    public function index(Request $request)
    {
        $products = Product::latest()->with(['supplier', 'category'])->paginate();
        $categories = Category::all();
        $suppliers = Supplier::all();
        $productsData = ProductResource::collection($products);
        return view('pages.Products.products', compact('productsData', 'categories', 'suppliers'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $validatedData = $request->validated();
            Product::create($validatedData);
            $this->showToast(__('dashboard.product.successfully_created'));
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
        }
    }

    public function update(ProductUpdateRequest $request, Product $product)
    { {
            try {
                $validatedData = $request->validated();

                $product->update($validatedData);

                $this->showToast(__('dashboard.product.successfully_updated'));

                return response()->json(['success' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
            }
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        $this->showToast(__('dashboard.product.successfully_deleted'));
        return redirect()->back();
    }
}
