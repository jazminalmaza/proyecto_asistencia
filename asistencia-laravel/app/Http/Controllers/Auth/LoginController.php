<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prosecretario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Muestra la vista del formulario
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesa el login
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'contraseña' => 'required',
        ]);

        // Buscamos el prosecretario
        $user = Prosecretario::where('usuario', $request->usuario)->first();

        // Verificación (Soporta texto plano o contraseñas encriptadas con Hash)
        if ($user && ($user->contraseña === $request->contraseña || Hash::check($request->contraseña, $user->contraseña))) {
            
            // Inicia la sesión en Laravel
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // Redirige al index/dashboard
        }

        // Si falla, regresa con el mensaje de error
        return back()->withErrors([
            'error' => 'Usuario o contraseña incorrectos.',
        ])->withInput();
    }

    // Cierra sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}