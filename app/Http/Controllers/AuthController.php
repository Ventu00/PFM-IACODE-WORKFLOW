<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255'],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        $name = trim(strip_tags($validated['name']));
        $email = Str::lower(trim($validated['email']));

        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $validated['password'],
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->withErrors([
                    'email' => 'No se ha podido completar el registro con los datos proporcionados.',
                ]);
        }

        return redirect()
            ->route('login')
            ->with('success', 'Si el registro se ha completado correctamente, ya puedes iniciar sesión.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);

        $email = Str::lower(trim($request->input('email')));
        $throttleKey = Str::lower($email . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()
                ->withInput($request->except('password'))
                ->withErrors([
                    'email' => 'Demasiados intentos. Inténtalo de nuevo más tarde.',
                ])
                ->with('retry_after', $seconds);
        }

        $credentials = [
            'email' => $email,
            'password' => $request->input('password'),
        ];

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 60);

            return back()
                ->withInput($request->except('password'))
                ->withErrors([
                    'email' => 'Las credenciales proporcionadas no son válidas.',
                ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
