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
        $productos = Producto::paginate(8);

        return view('web.index', compact('ajuste', 'productos'));
    }
    
    public function detalle_producto($id)
    {
        $ajuste = Ajuste::first();
        $producto = Producto::findOrFail($id);
        return view('web.detail', compact('ajuste', 'producto'));
    }
}
