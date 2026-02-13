<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ajuste;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) { 
            return redirect('/web/login');
        }
        return view('web.dashboard');
    }
    
    public function carrito()
    {
        if (!Auth::check()) { 
            return redirect('/web/login');
        }
        return view('web.carrito');
    }

    public function login()
    {
        $ajuste = Ajuste::first();
        return view('web.login', compact('ajuste'));
    }

    public function autenticacion(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'el correo o la contraseña son incorrectos',
        ]);
    }
}
