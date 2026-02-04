<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {

        $total_roles= Role::count();
        $total_users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'SUPER_ADMIN');
        })->count();
        return view('admin.index', compact('total_roles', 'total_users'));
    }
}
