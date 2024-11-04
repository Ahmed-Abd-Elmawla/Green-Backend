<?php

namespace App\Http\Controllers\Api\User\AccountStatement;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Invoice;
use App\Traits\Response;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\AccountStatement\AccountStatementResource;

class AccountStatementController extends Controller
{

    use Response;
    public function index(Request $request,Client $client)
    {
        $type = $request->type;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $collections = collect([]);
        $invoices = collect([]);

        if ($type === 'all' || $type === 'collections') {
            $collections = Collection::where('client_id', '=', $client->id)
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $start = Carbon::parse($startDate)->startOfDay();
                    $end = Carbon::parse($endDate)->endOfDay();
                    return $query->whereBetween('created_at', [$start, $end]);
                })->get();
        }

        if ($type === 'all' || $type === 'invoices') {
            $invoices = Invoice::where('client_id', '=', $client->id)
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $start = Carbon::parse($startDate)->startOfDay();
                    $end = Carbon::parse($endDate)->endOfDay();
                    return $query->whereBetween('created_at', [$start, $end]);
                })->get();
        }


        $merge = $collections->merge($invoices);

        $sortedMerge = $merge->sortByDesc('created_at');

        $data = AccountStatementResource::collection($sortedMerge->values());

        return $this->sendResponse(200, __('api.success'), $data, 200);
    }
}
