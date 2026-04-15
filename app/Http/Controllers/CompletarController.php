<?php

namespace App\Http\Controllers;

use App\Models\Completar;
use App\Models\Ajuste;
use App\Models\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompletarController extends Controller
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
        return view('web.completar', compact('ajuste', 'carritos'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Completar $completar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Completar $completar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Completar $completar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Completar $completar)
    {
        //
    }
}
