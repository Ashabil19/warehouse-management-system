<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Buat user dengan role default (misalnya 'user')
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Set role default jika perlu
            'role' => 'user', // ganti sesuai default role yang diinginkan
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Percabangan berdasarkan role untuk redirect setelah register
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'purchasing':
                return redirect()->route('purchasing.index');
            case 'logistik':
                return redirect()->route('logistik.index');
            case 'user':
                return redirect()->route('user.index');
            default:
                return redirect()->route('user.index'); // Atau route default lainnya
        }
    }

}
