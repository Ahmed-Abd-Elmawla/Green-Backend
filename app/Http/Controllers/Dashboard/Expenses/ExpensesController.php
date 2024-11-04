<?php

namespace App\Http\Controllers\Dashboard\Expenses;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use App\Traits\ShowToast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\User\UserMiniResource;
use App\Http\Resources\Dashboard\Expenses\ExpensesResource;
use Illuminate\Support\Facades\Log;


class ExpensesController extends Controller
{
    use ShowToast;

    public function index(Request $request)
    {
        $users = User::all();
        $expenses = Expense::whereHas('user', function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            })->latest()->paginate();
        $expensesData =ExpensesResource::collection($expenses);
        $usersData =UserMiniResource::collection($users);
        $flag = false;
        return view('pages.Expenses.expenses', compact('expensesData', 'usersData', 'flag'));
    }

    public function show($id,$startDate= null,$endDate= null)
    {
        $expenses = Expense::where('user_id', $id)
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = Carbon::parse($endDate)->endOfDay();
            return $query->whereBetween('created_at', [$start, $end]);
        })
        ->latest()->paginate();
        $users = User::all();
        $usersData =UserMiniResource::collection($users);
        $expensesData =ExpensesResource::collection($expenses);
        $flag = true;
        return view('pages.Expenses.expenses', compact('expensesData', 'usersData', 'flag','id','startDate','endDate'));
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        $this->showToast(__('dashboard.expense.successfully_deleted'));
        return redirect()->back();
    }
}

