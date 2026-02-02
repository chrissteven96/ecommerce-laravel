<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = User::query(); 
        if ($search) {
            $query->where('name', 'LIKE', '%'. $search .'%')
                    ->orWhere('email', 'LIKE', '%'. $search .'%');
        }
        $usuarios = $query->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rol' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        $usuario->assignRole($request->rol);

        return redirect()->route('admin.usuarios.index')
        ->with('mensaje', 'Usuario creado exitosamente')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rol' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|confirmed',

        ]);

        $usuario = User::find($id);
        $usuario->name = (request('name'));
        $usuario->email = (request('email'));
        $usuario->password = (request('password'));
        $usuario->save();

        $usuario->syncRoles(request('rol'));

        return redirect()->route('admin.usuarios.index')
        ->with('mensaje', 'Usuario actualizado exitosamente')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')
        ->with('mensaje', 'Usuario eliminado exitosamente')
        ->with('icono', 'success');
    }
}
