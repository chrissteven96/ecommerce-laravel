<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';
    
    protected $fillable = [
        'producto_id',
        'usuario_id',
        'cantidad',
    ];
    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
