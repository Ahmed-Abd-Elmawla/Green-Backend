<?php

namespace App\Http\Controllers\Dashboard\Collections;

use App\Traits\ShowToast;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Collections\CollectionsResource;

class CollectionsController extends Controller
{
    use ShowToast;

    public function index(Request $request)
    {
        $collections = Collection::whereHas('client', function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            })
            ->latest()->paginate();
        $collectionsData = CollectionsResource::collection($collections);
        return view('pages.Collections.collections', compact('collectionsData'));
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();
        $this->showToast(__('dashboard.collection.successfully_deleted'));
        return redirect()->back();
    }
}

