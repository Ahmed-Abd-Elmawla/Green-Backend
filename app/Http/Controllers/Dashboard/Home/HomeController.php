<?php

namespace App\Http\Controllers\Dashboard\Home;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Supplier;
use App\Traits\Response;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    use Response;
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

    private static function getDate(){
        $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();
        return [$startOfMonth, $endOfMonth];
    }

    public function index(){
        [$startOfMonth, $endOfMonth] = self::getDate();
        $clients = Client::count();
        $users = User::count();
        $products = Product::count();
        $suppliers = Supplier::count();
        return view('layouts.HomePage', compact('clients', 'users', 'products', 'suppliers'));
    }
}
