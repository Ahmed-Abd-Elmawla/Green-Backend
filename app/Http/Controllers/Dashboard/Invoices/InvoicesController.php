<?php

namespace App\Http\Controllers\Dashboard\Invoices;

use App\Models\Invoice;
use App\Traits\ShowToast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Invoices\InvoicesResource;

class InvoicesController extends Controller
{
    use ShowToast;

    public function index(Request $request)
    {
        $invoices = Invoice::whereHas('client', function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('code', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->payment_type, function ($q) use ($request) {
                $q->where('payment_type', 'LIKE', '%'. $request->payment_type. '%');
            })->latest()->paginate();
        $invoicesData = InvoicesResource::collection($invoices);
        return view('pages.Invoices.invoices', compact('invoicesData'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        $this->showToast(__('dashboard.invoice.successfully_deleted'));
        return redirect()->back();
    }
}

