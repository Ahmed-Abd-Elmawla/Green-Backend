<?php
namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth._login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // return redirect()->intended('/welcome');
            // toast('Success Toast','success')->position('top-start')->flash();

            // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->position('top-end')->flash();


            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
