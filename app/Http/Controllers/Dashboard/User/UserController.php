<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserRequest;
use App\Http\Resources\Dashboard\User\UserResource;
use App\Http\Requests\Dashboard\User\UserUpdateRequest;
use App\Traits\ShowToast;

class UserController extends Controller
{
    use ShowToast;

    public function all_list(Request $request)
    {
        $users = User::latest()->get();
        return UserResource::collection($users)->additional(['status' => 200, 'message' => __('dashboard.success')]);
    }

    public function index(Request $request)
    {
        $users = User::when($request->search, function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%');
        })
            ->when(!is_null($request->is_active), function ($q) use ($request) {
                $q->where('is_active', $request->is_active);
            })
            ->latest()->paginate();
        $representatives = UserResource::collection($users);
        return view('pages.Representatives.representatives', compact('representatives'));
    }

    public function store(UserRequest $request)
    {
        try {
        $validatedData = $request->validated();
        User::create($validatedData );
        $this->showToast(__('dashboard.representative.successfully_created'));
        return response()->json(['success' => true], 200);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
    }
    }

    public function show(User $user)
    {
        return UserResource::make($user)->additional(['status' => 200, 'message' => __('dashboard.success')]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        {
            try {
                $validatedData = $request->validated();

                if ($request->has('password')) {
                    $user->update([
                        'password' => Hash::make($validatedData['password']),
                    ]);
                }

                $user->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'phone' => $validatedData['phone']
                ]);

                $this->showToast(__('dashboard.representative.successfully_updated'));

                return response()->json(['success' => true], 200);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
            }
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        $this->showToast(__('dashboard.representative.successfully_deleted'));
        return redirect()->back();
    }

    public function deleted_list(Request $request)
    {
        // Retrieve only the soft-deleted users
        $deletedUsers = User::onlyTrashed()->latest()->get();

        // Return the collection of deleted users with a status and message
        return UserResource::collection($deletedUsers)->additional(['status' => 200, 'message' => __('dashboard.success')]);
    }

}
