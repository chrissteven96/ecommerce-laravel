<?php

namespace App\Http\Controllers;

use App\Models\Completar;
use App\Models\Ajuste;
use App\Models\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Orden;
use App\Models\DetalleOrden;


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
        if ($usuario = Auth::user()) {
            DB::beginTransaction();
            try {

                //guarda la orden
                $orden = new Orden();
                $orden->usuario_id = $usuario->id;
                $orden->estado_pago = $request->estado_pago;
                $orden->estado_orden = $request->estado_orden;
                $orden->transaccion_id = $request->transaccion_id;
                $orden->divisa = $request->divisa;
                $orden->total = $request->total;
                $orden->direccion_envio = $request->direccion_envio;
                $orden->save();

                //guarda los detalles de la orden
                $carritos = Carrito::where('usuario_id', $usuario->id)->get();
                foreach ($carritos as $item) {
                    $detalle = new DetalleOrden();
                    $detalle->orden_id = $orden->id;
                    $detalle->producto_id = $item->producto_id;
                    $detalle->cantidad = $item->cantidad;
                    $detalle->precio = $item->producto->precio_venta;
                    $detalle->save();
 
                    //descontar stock
                    $producto = $item->producto;
                    $producto->stock -= $item->cantidad;
                    $producto->save();

                    //eliminar el producto del carrito
                    $item->delete();
                }

                DB::commit();
                return redirect()->route('web.dashboard')->with('mensaje', 'Pedido procesado correctamente')->with('icono', 'success')->with('btn', true)->with('timer', 0)->with('texto_extra', 'Revisa tu correo para confirmar el pago y proceder con el envío');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error al procesar el pedido: ' . $e->getMessage());
                Log::error('Error al procesar el pedido: ' . $e->getTraceAsString());
                return redirect()->route('web.carrito.index')->with('mensaje', 'Error al procesar el pedido')->with('icono', 'error')->with('btn', true)->with('timer', 3000);
            }
        }
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
