<?php

namespace App\Http\Controllers;

use App\Models\Completar;
use App\Models\Ajuste;
use App\Models\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    /**
     * Enviar detalles del carrito a WhatsApp
     */
    public function enviarWhatsApp(Request $request)
    {
        // Depuración: Ver todos los datos recibidos
        Log::info('Datos recibidos en enviarWhatsApp:', $request->all());
        
        if (!Auth::check()) {
            return redirect()->route('web.login');
        }

        $whatsapp = $request->input('whatsapp');
        Log::info('WhatsApp: ' . $whatsapp);
        
        $carritos = Carrito::where('usuario_id', Auth::user()->id)
            ->with('producto')
            ->get();

        Log::info('Carritos encontrados: ' . $carritos->count());

        if ($carritos->isEmpty()) {
            return redirect()->back()
                ->with('mensaje', 'El carrito está vacío')
                ->with('icono', 'warning');
        }

        // Generar mensaje para WhatsApp
        $mensaje = "¡Hola! Quiero realizar un pedido:\n\n";
        $mensaje .= "=== DETALLE DEL PEDIDO ===\n\n";
        
        $total = 0;
        foreach ($carritos as $item) {
            $subtotal = $item->cantidad * $item->producto->precio_venta;
            $total += $subtotal;
            
            $mensaje .= "Producto: " . $item->producto->nombre . "\n";
            $mensaje .= "Descripción: " . $item->producto->descripcion_corta . "\n";
            $mensaje .= "Cantidad: " . $item->cantidad . "\n";
            $mensaje .= "Precio unitario: $" . number_format($item->producto->precio_venta, 2) . "\n";
            $mensaje .= "Subtotal: $" . number_format($subtotal, 2) . "\n";
            $mensaje .= "---\n";
        }
        
        $mensaje .= "\nTOTAL A PAGAR: $" . number_format($total, 2) . "\n\n";
        $mensaje .= "=== DATOS DE CONTACTO ===\n";
        $mensaje .= "Nombre: " . $request->input('first_name') . " " . $request->input('last_name') . "\n";
        $mensaje .= "Email: " . $request->input('email') . "\n";
        $mensaje .= "Teléfono: " . $request->input('phone') . "\n";
        $mensaje .= "WhatsApp: " . $whatsapp . "\n";
        $mensaje .= "Dirección: " . $request->input('address') . ", " . $request->input('city') . ", " . $request->input('state') . "\n\n";
        $mensaje .= "¡Espero su confirmación!";

        // Codificar mensaje para URL
        $mensajeCodificado = urlencode($mensaje);
        
        // Número de WhatsApp de la empresa (configúralo con tu número real)
        $numeroEmpresa = '593994768702'; // Tu número de WhatsApp
        
        // Redirigir a WhatsApp Web
        $whatsappUrl = "https://wa.me/{$numeroEmpresa}?text={$mensajeCodificado}";
        
        Log::info('URL generada: ' . $whatsappUrl);
        Log::info('Redirigiendo a WhatsApp...');
        
        return redirect()->away($whatsappUrl);
    }
}
