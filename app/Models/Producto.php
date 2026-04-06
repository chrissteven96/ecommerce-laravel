<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carrito;
use App\Models\DetalleOrden;

class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory;
    
    protected $fillable = [
        'categoria_id',
        'nombre',
        'slug',
        'codigo',
        'descripcion_corta',
        'descripcion_larga',
        'precio_compra',
        'precio_venta',
        'stock',
    ];
    
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
    public function imagenes()
    {
        return $this->hasMany(ImagenesProducto::class);
    }
    
    public function favoritos()
    {
        return $this->hasMany(ProductoFavorito::class, 'producto_id');
    }

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'producto_id');
    }
    
    public function detalleOrden()
    {
        return $this->hasMany(DetalleOrden::class, 'producto_id');
    }
}
