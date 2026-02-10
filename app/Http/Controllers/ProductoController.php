<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\ImagenesProducto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ajuste = Ajuste::first();
        $search = $request->get('search');
        $query = Producto::query();
        if ($search) {
            $query->where('nombre', 'LIKE', '%'.$search.'%')
                ->orWhere('codigo', 'LIKE', '%'.$search.'%')
                ->orWhere('descripcion_corta', 'LIKE', '%'.$search.'%')
                ->orWhere('descripcion_larga', 'LIKE', '%'.$search.'%');
        }
        $productos = $query->paginate(10);
        return view('admin.productos.index', compact('productos', 'ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:productos,slug',
        'codigo' => 'required|string|max:100|unique:productos,codigo',
        'descripcion_corta' => 'required|string|max:500',
        'descripcion_larga' => 'required|string',
        'precio_compra' => 'required|numeric|min:0',
        'precio_venta' => 'required|numeric|min:0',
        'stock' => 'required|numeric|min:0',
        'categoria_id' => 'required|exists:categorias,id',
        'images' => 'required|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
    ]);

    DB::transaction(function () use ($request) {

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->slug = $request->slug;
        $producto->codigo = $request->codigo;
        $producto->descripcion_corta = $request->descripcion_corta;
        $producto->descripcion_larga = $request->descripcion_larga;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();

        // Guardar imágenes
        foreach ($request->file('images') as $index => $image) {

            $path = $image->store('productos', 'public');

            ImagenesProducto::create([
                'producto_id' => $producto->id,
                'imagen' => $path,
                'is_principal' => $index === 0 // primera imagen
            ]);
        }
    });

    return redirect()
        ->route('admin.productos.index')
        ->with('mensaje', 'Producto creado exitosamente')
        ->with('icono', 'success');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        $imagenes = ImagenesProducto::where('producto_id', $producto->id)->get();
        return view('admin.productos.show', compact('producto', 'imagenes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         $producto = Producto::findOrFail($id);
         $categorias = Categoria::all();
        $imagenes = ImagenesProducto::where('producto_id', $producto->id)->get();

      
        
        return view('admin.productos.edit', compact('producto', 'categorias', 'imagenes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:productos,slug,' . $id,
            'codigo' => 'required|string|max:100|unique:productos,codigo,' . $id,
            'descripcion_corta' => 'required|string|max:500',
            'descripcion_larga' => 'required|string',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->slug = $request->slug;
        $producto->codigo = $request->codigo;
        $producto->descripcion_corta = $request->descripcion_corta;
        $producto->descripcion_larga = $request->descripcion_larga;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;
        // $producto->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('productos', 'public');

                ImagenesProducto::create([
                    'producto_id' => $producto->id,
                    'imagen' => $path,
                ]);
            }
        }

         return redirect()
             ->route('admin.productos.index')
             ->with('mensaje', 'Producto actualizado exitosamente')
             ->with('icono', 'success');
        
    //     return response()->json([   'imagenes' => ImagenesProducto::where('producto_id', $id)->get()]);
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyImagen($id)
    {
         $imagen = ImagenesProducto::findOrFail($id);
         if (Storage::disk('public')->exists($imagen->imagen)) {
             Storage::disk('public')->delete($imagen->imagen);
         }
         $imagen->delete();
        return redirect()
             ->route('admin.productos.edit', $imagen->producto_id)
             ->with('mensaje', 'Imagen eliminada exitosamente')
             ->with('icono', 'success');
        
        // return response()->json([$imagen]);
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {

        $producto = Producto::with('imagenes')->findOrFail($id);

        // return response()->json($imagenes->pluck('imagen'));

        foreach ($producto->imagenes as $img) {
            if (Storage::disk('public')->exists($img->imagen)) {
                Storage::disk('public')->delete($img->imagen);
            }
        }

        ImagenesProducto::where('producto_id', $id)->delete();
        $producto->delete();

        

        });
        return redirect()
            ->route('admin.productos.index')
            ->with('mensaje', 'Producto eliminado exitosamente')
            ->with('icono', 'success');
    }   
}
