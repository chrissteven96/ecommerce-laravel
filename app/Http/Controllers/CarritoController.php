<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            if (!Auth::check()) {
            return redirect()->route('web.login')
            ->with('mensaje', 'Debes iniciar sesión para acceder a esta página')
            ->with('icono', 'warning');
        }
        $ajuste = Ajuste::first();
        $carritos = Carrito::where('usuario_id', Auth::user()->id)
            ->with('producto.imagenes')
            ->get();
        return view('web.carrito', compact('carritos', 'ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $carrito_existente = Carrito::where('producto_id', $request->producto_id)
            ->where('usuario_id', Auth::user()->id)
            ->first();

            if ($carrito_existente) {
                $carrito_existente->cantidad += $request->cantidad;
                $carrito_existente->save();
            } else {
                Carrito::create([
                    'producto_id' => $request->producto_id,
                    'cantidad' => $request->cantidad,
                    'usuario_id' => Auth::user()->id,
                ]);


            }
        
        return redirect()->route('web.carrito.index')
            ->with('mensaje', 'Producto agregado al carrito')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carrito $carrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'carrito_id' => 'required|exists:carritos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $carrito = Carrito::findOrFail($request->carrito_id);
        $carrito->cantidad = $request->cantidad;
        $carrito->save();
        
        return redirect()->route('web.carrito.index')
            ->with('mensaje', 'Cantidad actualizada')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carrito = Carrito::findOrFail($id);
        $carrito->delete();
        
        return redirect()->route('web.carrito.index')
            ->with('mensaje', 'Producto eliminado del carrito')
            ->with('icono', 'success');
    }

    public function limpiar()
    {
        Carrito::where('usuario_id', Auth::user()->id)->delete();
        
        return redirect()->route('web.carrito.index')
            ->with('mensaje', 'Carrito vaciado')
            ->with('icono', 'success');
    }
}
