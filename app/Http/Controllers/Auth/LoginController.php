<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validation des données
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentative de connexion
        if (Auth::attempt($request->only('username', 'password'))) {
            // Rediriger après connexion réussie
            return redirect()->intended('/login');
        }

        // Si la connexion échoue
        return back()->withErrors([
            'login' => 'Nom d’utilisateur ou mot de passe incorrect.',
        ])->withInput($request->except('password'));
    }
}
