<?php

namespace App\Http\Controllers\Dashboard\Expenses;

use App\Models\Expense;
use App\Traits\ShowToast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Expenses\ExpensesResource;

class ExpensesController extends Controller
{
    use ShowToast;

    public function index(Request $request)
    {
        $expenses = Expense::whereHas('user', function($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            })
            ->latest()->paginate();
        $expensesData =ExpensesResource::collection($expenses);
        return view('pages.Expenses.expenses', compact('expensesData'));
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        $this->showToast(__('dashboard.expense.successfully_deleted'));
        return redirect()->back();
    }
}

