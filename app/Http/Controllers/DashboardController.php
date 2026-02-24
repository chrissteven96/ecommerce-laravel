<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ajuste;
use App\Models\User;

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

    public function registro(Request $request)
    {

        $ajuste = Ajuste::first();
        return view('web.registro', compact('ajuste'));
    }

    public function registro_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

         $user = new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = bcrypt($request->password);
         $user->save();
         $user->assignRole('CLIENTE');

        Auth::login($user);

        return redirect()->intended('/dashboard');
        
    }
}
