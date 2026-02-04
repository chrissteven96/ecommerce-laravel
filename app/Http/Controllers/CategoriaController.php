<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $search = $request->get('search');
        $query = Categoria::query();
        if ($search) {
            $query->where('nombre', 'LIKE', "%$search%");
        }
        $categorias = $query->paginate(10);
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'string|max:255',
        ]);
        
        $categoria = new Categoria();
        $categoria->nombre = $request->name;
        
        $categoria->slug = $request->slug;
        $categoria->descripcion = $request->description;
        $categoria->save();

        return redirect()->route('admin.categorias.index')
        ->with('mensaje', 'Categoria creada exitosamente')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'string|max:255|unique:categorias,slug,' . $id,
        ]);
        
        $categoria = Categoria::find($id);
        $categoria->nombre = $request->name;
        $categoria->slug = $request->slug;
        $categoria->descripcion = $request->description;
        $categoria->save();

        return redirect()->route('admin.categorias.index')
        ->with('mensaje', 'Categoria actualizada exitosamente')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();
        return redirect()->route('admin.categorias.index')
        ->with('mensaje', 'Categoria eliminada exitosamente')
        ->with('icono', 'success');
    }
}
