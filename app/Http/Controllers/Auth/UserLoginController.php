<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_reg' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('no_reg', $request->no_reg)->where('role', 'nasabah')->first();
        if ($user && \Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('user.dashboard');
        }
        return back()->with('error', 'No registrasi atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }
}
