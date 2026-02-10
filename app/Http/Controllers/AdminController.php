<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Producto;
use App\Models\Categoria;
        
class AdminController extends Controller
{
    public function index()
    {

        $total_categorias = Categoria::count();
        $total_productos = Producto::count();
        $total_roles= Role::count();
        $total_users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'SUPER_ADMIN');
        })->count();
        return view('admin.index', compact('total_roles', 'total_users', 'total_productos', 'total_categorias'));
    }
}
