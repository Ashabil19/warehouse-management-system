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
        // Cek apakah autentikasi berhasil  
        if (!Auth::attempt($request->only('email', 'password'))) {  
            // Jika gagal, kembalikan dengan pesan kesalahan  
            return back()->withErrors([  
                'login' => 'Login gagal. Pastikan email dan password Anda benar.',  
            ])->withInput();  
        }  
  
        $request->session()->regenerate();  
  
        // Ambil pengguna yang terautentikasi  
        $user = Auth::user();  
        $intendedUrl = $request->get('redirect', '/'); // Ambil URL redirect dari query string  
  
        // Cek apakah pengguna memiliki akses ke URL yang diminta  
        if ($this->userHasAccess($user, $intendedUrl)) {  
            // Redirect ke halaman yang diinginkan setelah login  
            return redirect()->intended($intendedUrl); // Redirect ke URL yang diminta  
        } else {  
            // Jika tidak memiliki akses, logout dan kembalikan dengan pesan kesalahan  
            Auth::logout();  
            return back()->withErrors([  
                'login' => 'Login gagal. Anda tidak memiliki akses ke halaman ini.',  
            ])->withInput();  
        }  
    }  
  
    /**  
     * Cek apakah pengguna memiliki akses ke URL yang diminta.  
     */  
    private function userHasAccess($user, $url)  
    {  
        // Logika untuk memeriksa apakah pengguna memiliki akses berdasarkan role  
        if (strpos($url, 'inputbarang') !== false && !$user->hasRole('purchasing')) {  
            return false;  
        }  
  
        if (strpos($url, 'barangmasuk') !== false && !$user->hasRole('logistik')) {  
            return false;  
        }  
  
        // Tambahkan logika lain sesuai kebutuhan  
        return true;  
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
