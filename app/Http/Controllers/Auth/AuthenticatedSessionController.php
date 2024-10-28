<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentikasi user
        $request->authenticate();
    
        // Regenerasi session untuk keamanan
        $request->session()->regenerate();
    
        // Ambil role user yang sedang login
        $role = $request->user()->role;
    
        // Percabangan berdasarkan role
        switch ($role) {
            case 'admin':
                return redirect()->intended(route('admin.dashboard'));
            case 'purchasing':
                return redirect()->intended(route('purchasing.index'));
            case 'logistik':
                return redirect()->intended(route('logistik.index'));
            case 'user':
                return redirect()->intended(route('user.dashboard'));
            default:
                // Jika role tidak terdaftar, bisa diarahkan ke halaman default
                return redirect()->intended(route('dashboard'));
        }
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
