<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\ProductoFavorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoFavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $ajuste = Ajuste::first();
        $favoritos = ProductoFavorito::where('usuario_id', Auth::user()->id)
            ->with('producto.imagenes')
            ->get();
        return view('web.favoritos', compact('favoritos', 'ajuste'));
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
        request()->validate([
            'producto_id' => 'required|exists:productos,id',
        ]);

        if (ProductoFavorito::where('usuario_id', Auth::user()->id)->where('producto_id', $request->input('producto_id'))->exists()) {
            return redirect()
                ->back()
                ->with('mensaje', 'Producto ya está en favoritos')
                ->with('icono', 'warning');
        }

        $productoFavorito = new ProductoFavorito();
        $productoFavorito->usuario_id = Auth::user()->id;
        $productoFavorito->producto_id = $request->input('producto_id');
        $productoFavorito->save();
        

        return redirect()
        ->back()
        ->with('mensaje', 'Producto agregado a favoritos')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductoFavorito $productoFavorito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductoFavorito $productoFavorito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductoFavorito $productoFavorito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoFavorito $productoFavorito)
    {
        //
    }
}
