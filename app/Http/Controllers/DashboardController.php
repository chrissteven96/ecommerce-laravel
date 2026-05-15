<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ajuste;
use App\Models\User;
use App\Models\ProductoFavorito;
use App\Models\Orden;
use App\Models\DetalleOrden;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) { 
            return redirect('/web/login')
            ->with('error', 'Debes iniciar sesión para acceder a esta página')
            ->with('icono', 'warning');
        }
        $ajuste = Ajuste::first();
        $favoritos = ProductoFavorito::where('usuario_id', Auth::user()->id)
        ->with('producto.imagenes')
        ->get();
        $misordenes = Orden::where('usuario_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(4);
        $detalleorden = DetalleOrden::whereIn('orden_id', $misordenes->pluck('id'))
        ->with('producto.imagenes')
        ->get();

        return view('web.dashboard', compact('ajuste', 'favoritos', 'misordenes', 'detalleorden'));
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
