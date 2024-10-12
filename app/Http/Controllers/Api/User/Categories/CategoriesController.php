<?php

namespace App\Http\Controllers\Api\User\Categories;


use App\Models\Product;
use App\Models\Category;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Products\ProductsResource;
use App\Http\Resources\Api\User\Categories\CategoriesMiniResource;

class CategoriesController extends Controller
{
    use Response;

    public function index(Request $request)
    {
        $categories = Category::all();

        $data = CategoriesMiniResource::collection($categories);
        return $this->sendResponse(200, __('api.success'), $data, 200);
    }

    public function show($id)
    {
        $category = Category::whereUuid($id)->first();
        $products = Product::where('category_id', $category->id)->latest()->paginate(10);
        return ProductsResource::collection($products)->additional([
            'status' => 200,
            'message' =>  __('api.success'),
        ]);
    }
}
