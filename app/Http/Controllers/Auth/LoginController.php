<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan model User diimpor

class LoginController extends Controller
{
    /**
     * Konstruktor untuk middleware guest.
     * Mencegah pengguna yang sudah login mengakses halaman login.
     */
    public function __construct()
    {
        // Middleware 'guest' memastikan hanya pengguna yang belum login yang bisa mengakses metode ini.
        // Namun, untuk kasus ini, kita akan menambahkan logika manual di showLoginForm
        // agar lebih eksplisit dalam mengalihkan berdasarkan role.
        // Alternatif: $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        // Jika pengguna sudah terautentikasi
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
        // Ambil role dari query string jika ada
        $role = $request->query('role');
        return view('auth.login', compact('role'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $role = $request->input('role', $request->query('role'));
        $user = User::where('no_reg', $request->username)->first();

        if ($user && \Hash::check($request->password, $user->password)) {
            // Validasi role jika ada
            if ($role && $user->role !== $role) {
                return back()->with('error', 'Anda tidak memiliki akses ke halaman login ini.');
            }
            Auth::login($user);
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
        return redirect('/'); // Arahkan ke halaman welcome setelah logout
    }
}
