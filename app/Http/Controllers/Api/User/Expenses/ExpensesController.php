<?php

namespace App\Http\Controllers\Api\User\Expenses;

use Throwable;
use App\Traits\Response;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\Expenses\ExpenseResource;
use App\Http\Requests\Api\User\Expenses\ExpenseRequest;


class ExpensesController extends Controller
{
    use Response;

    public function index(Request $request){
        $expenses = Expense::where('user_id', auth('user')->user()->id)
            ->latest()->paginate();

        return ExpenseResource::collection($expenses)->additional([
            'status' => 200,
            'message' =>  __('api.success'),
        ]);
    }

    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $user = auth('user')->user();
        if (!$user) {
            return $this->sendResponse(401, __('api.not_auth_login'), null, 401);
        }

        $data['user_id'] = $user->id;

        DB::beginTransaction();
        try {

            $expense = Expense::create($data);

            DB::commit();
            return $this->sendResponse(200, __('api.invoice.expense_successfully_created'), ExpenseResource::make($expense), 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->sendResponse(500, __('api.error'), null, 500);
        }
    }
}
