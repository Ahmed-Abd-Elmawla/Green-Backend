<?php

namespace App\Http\Controllers\Dashboard\Admins;

use App\Models\Admin;
use App\Traits\AlertPosition;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\admins\AddAdminRequest;
use App\Http\Requests\Dashboard\admins\UpdateAdminRequest;
use App\Http\Resources\Dashboard\admins\AdminInfoResource;

class AdminsController extends Controller
{
    use AlertPosition;
    public function index()
    {
        $admins = Admin::active()->latest()->paginate();
        // return response()->json($admins);
        return view('pages.Admins.AdminList', compact('admins'));
    }

    public function store(AddAdminRequest $request)
    {
        try {
            $validatedData = $request->validated();

            Admin::create($validatedData);

            toast(__('dashboard.admin.successfully_created'), 'success')->timerProgressBar()->width('350px')->padding('10px')->position($this->position())->flash();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
        }
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        try {
            $validatedData = $request->validated();

            if ($request->has('password')) {
                $admin->update([
                    'password' => Hash::make($validatedData['password']),
                ]);
            }

            $admin->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone']
            ]);

            toast(__('dashboard.admin.successfully_updated'), 'success')->timerProgressBar()->width('350px')->padding('10px')->position($this->position())->flash();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => '__(\'dashboard.validation.went_wrong\'): ' . $e->getMessage()], 500);
        }
    }

    public function destroy(Admin $admin)
    {
        // dd($this->position());
        $admin->delete();
        toast(__('dashboard.admin.successfully_deleted'), 'success')->timerProgressBar()->width('350px')->padding('10px')->position($this->position())->flash();
        return redirect()->back();
    }
}
