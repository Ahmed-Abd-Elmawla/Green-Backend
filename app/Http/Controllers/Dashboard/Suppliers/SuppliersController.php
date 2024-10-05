<?php

namespace App\Http\Controllers\Dashboard\Suppliers;

use App\Models\Supplier;
use App\Traits\ShowToast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Suppliers\SupplierRequest;
use App\Http\Requests\Dashboard\Suppliers\SupplierUpdateRequest;
use App\Http\Resources\Dashboard\Suppliers\SupplierMiniResource;
use App\Http\Resources\Dashboard\Suppliers\SupplierResource;

class SuppliersController extends Controller
{
    use ShowToast;

    public function all_list(Request $request)
    {
        $suppliers = Supplier::latest()->get();
        return SupplierMiniResource::collection($suppliers);
    }

    public function index(Request $request)
    {
        $suppliers = Supplier::when($request->search, function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%');
        })
            ->latest()->paginate();
        $suppliersData = SupplierResource::collection($suppliers);
        return view('pages.Suppliers.suppliers', compact('suppliersData'));
    }

    public function store(SupplierRequest $request)
    {
        try {
        $validatedData = $request->validated();
        Supplier::create($validatedData );
        $this->showToast(__('dashboard.supplier.successfully_created'));
        return response()->json(['success' => true], 200);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
    }
    }

    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        {
            try {
                $validatedData = $request->validated();

                $supplier->update($validatedData);

                $this->showToast(__('dashboard.supplier.successfully_updated'));

                return response()->json(['success' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
            }
        }
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        $this->showToast(__('dashboard.supplier.successfully_deleted'));
        return redirect()->back();
    }

}
