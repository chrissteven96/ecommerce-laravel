<!DOCTYPE html>
<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; }
        .total { font-weight: bold; font-size: 1.2em; }
        .banco-box { background: #e9ecef; padding: 20px; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <h2>¡Gracias por tu compra, {{ $orden->usuario->name }}!</h2>
    <p>Hemos recibido tu pedido <strong>#{{ $orden->id }}</strong>. A continuación verás el resumen de tus productos:</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orden->detalle as $item)
            <tr>
                <td>{{ $item->producto->nombre }}</td> <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->precio, 2) }}</td>
                <td>${{ number_format($item->precio * $item->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="right" class="total">Total a pagar:</td>
                <td class="total">${{ number_format($orden->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="banco-box">
        <h3>🏦 Datos para tu Depósito o Transferencia</h3>
        <p><strong>Banco:</strong> Banco Pichincha</p>
        <p><strong>Cuenta de Ahorros:</strong> 1234567890</p>
        <p><strong>Beneficiario:</strong> Tu Nombre/Empresa</p>
        <p><strong>Concepto:</strong> Pedido #{{ $orden->id }}</p>
    </div>

    <p><em>Una vez realizado el pago, por favor envía una foto del comprobante para procesar tu envío.</em></p>
</body>
</html>