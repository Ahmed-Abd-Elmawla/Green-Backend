<?php

namespace App\Http\Controllers\Dashboard\Finances;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Invoice;
use App\Traits\Response;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Clients\ClientMiniResource;
use App\Http\Resources\Api\User\AccountStatement\AccountStatementResource;
use App\Models\Expense;

class FinancesController extends Controller
{

    use Response;

    public function index()
    {
        $collections = Collection::sum('amount');
        $cashInvoices = Invoice::where('payment_type', 'cash')->sum('total_amount');
        $postpaidInvoices = Invoice::where('payment_type', 'postpaid')->sum('paid');
        $income = $collections + $cashInvoices + $postpaidInvoices;
        $outcome = Expense::sum('amount');
        $postpaid = Client::where('net_account', '<', 0)->sum('net_account');
        return view('pages.Finances.finances', compact('income', 'postpaid', 'outcome'));
    }
    public function show(Request $request)
    {
        $type = $request->type;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if ($type === 'income') {
            $collections = Collection::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = Carbon::parse($endDate)->endOfDay();
                return $query->whereBetween('created_at', [$start, $end]);
            })->sum('amount');


            $cashInvoices = Invoice::where('payment_type', 'cash')
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $start = Carbon::parse($startDate)->startOfDay();
                    $end = Carbon::parse($endDate)->endOfDay();
                    return $query->whereBetween('created_at', [$start, $end]);
                })->sum('total_amount');

            $postpaidInvoices = Invoice::where('payment_type', 'postpaid')
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    $start = Carbon::parse($startDate)->startOfDay();
                    $end = Carbon::parse($endDate)->endOfDay();
                    return $query->whereBetween('created_at', [$start, $end]);
                })->sum('paid');

            $income = $collections + $cashInvoices + $postpaidInvoices;

            return response()->json(['data' => $income,'type' => 'income']);
        }

        if ($type === 'outcome') {
            $outcome = Expense::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = Carbon::parse($endDate)->endOfDay();
                return $query->whereBetween('created_at', [$start, $end]);
            })->sum('amount');

            return response()->json(['data' => $outcome,'type' => 'outcome']);
        }
    }
}
