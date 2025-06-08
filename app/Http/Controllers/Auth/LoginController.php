<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required', // tetap gunakan name input 'username' di form
            'password' => 'required',
        ]);

        // Login hanya menggunakan no_reg
        $user = \App\Models\User::where('no_reg', $request->username)->first();

        if ($user && \Hash::check($request->password, $user->password)) {
            \Auth::login($user);
            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
        return back()->with('error', 'No Registrasi atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
