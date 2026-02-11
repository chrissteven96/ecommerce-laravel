<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Ajuste;
use App\Models\Producto;

class WebController extends Controller
{
    public function index()
    {
        $ajuste = Ajuste::first();
        $productos = Producto::all();

        return view('web.index', compact('ajuste', 'productos'));
    }
}
