<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('admin.ajustes.index');

        // echo $jsonData = file_get_contents(asset('https://api.hilariweb.com/divisas'));

        $ajuste = Ajuste::first();

        $jsonData = file_get_contents(public_path('moneda.json'));
        $monedas = json_decode($jsonData, true);
        return view('admin.ajustes.index', compact('monedas', 'ajuste'));


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
        // return response()->json($request->all());

        $ajuste = Ajuste::first();

        $rules = [
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
            'sucursal'    => 'required|string|max:255',
            'direccion'   => 'required|string|max:255',
            'telefono'    => 'required|string|max:50',
            'email'       => 'required|email|max:255',
            'divisa'      => 'required|string|max:50',
            'pagina_web'  => 'nullable|url|max:255',
        ];

        if($ajuste){
            $rules['logo'] = 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048';
            $rules['img_login'] = 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:4096';
        }else{
            $rules['logo'] = 'required|image|mimes:jpg,jpeg,png,webp,svg|max:2048';
            $rules['img_login'] = 'required|image|mimes:jpg,jpeg,png,webp,svg|max:4096';
        }

        $request->validate($rules);

        if(!$ajuste){
            $ajuste= new Ajuste();
        }

 
        $ajuste->nombre = $request->nombre;
        $ajuste->descripcion = $request->descripcion;
        $ajuste->sucursal = $request->sucursal;
        $ajuste->direccion = $request->direccion;
        $ajuste->telefono = $request->telefono;
        $ajuste->email = $request->email;
        $ajuste->divisa = $request->divisa;
        $ajuste->pagina_web = $request->pagina_web;   
        
        if($request->hasFile('logo')){
            if($ajuste->logo && Storage::disk('public')->exists($ajuste->logo)){
                Storage::disk('public')->delete($ajuste->logo);
            }
            
            $ajuste->logo = $request->file('logo')->store('logos', 'public');
        }


        if($request->hasFile('img_login')){
            if($ajuste->img_login && Storage::disk('public')->exists($ajuste->img_login)){
                Storage::disk('public')->delete($ajuste->img_login);
            }
            
            $ajuste->img_login = $request->file('img_login')->store('img_login', 'public');

        $ajuste->save();

    }
    
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Ajuste $ajuste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajuste $ajuste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
