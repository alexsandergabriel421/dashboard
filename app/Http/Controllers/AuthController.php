<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    // Página de login
    public function loginPage()
    {
        return view('auth.login');
    }

    // Página de cadastro
    public function registerPage()
    {
        return view('auth.register');
    }

    // Processar cadastro
    public function register(RegisterRequest $request)
    {
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('mensagem', 'Cadastro realizado com sucesso!');
    }

    // Processar login
    public function login(LoginRequest $request)
    {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'E-mail ou senha inválidos.']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
