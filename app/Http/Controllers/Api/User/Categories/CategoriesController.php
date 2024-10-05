<?php

namespace App\Http\Controllers\Api\User\Categories;


use App\Models\Category;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Categories\CategoriesResource;
use App\Http\Resources\Api\User\Categories\CategoriesMiniResource;

use function PHPUnit\Framework\isEmpty;

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
        $category = Category::whereUuid($id)->with('products')->first();
        $categoryData = new CategoriesResource($category);
        return $this->sendResponse(200, __('api.success'), $categoryData, 200);
    }
}
