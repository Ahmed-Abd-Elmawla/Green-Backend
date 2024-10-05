<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Models\Category;
use App\Traits\ShowToast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use App\Http\Resources\Dashboard\Categories\CategoryResource;

class CategoriesController extends Controller
{
    use ShowToast;

    public function index(Request $request)
    {
        $categories = Category::latest()->paginate();
        $categoriesData = CategoryResource::collection($categories);
        return view('pages.Categories.categories', compact('categoriesData'));
    }

    public function store(CategoryRequest $request)
    {
        try {
        $validatedData = $request->validated();
        Category::create($validatedData );
        $this->showToast(__('dashboard.category.successfully_created'));
        return response()->json(['success' => true], 200);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
    }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        {
            try {
                $validatedData = $request->validated();

                $category->update($validatedData);

                $this->showToast(__('dashboard.category.successfully_updated'));

                return response()->json(['success' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
            }
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        $this->showToast(__('dashboard.category.successfully_deleted'));
        return redirect()->back();
    }
}

