<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'precio',
        'imagen',
        'stock',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_producto');
    }

    public function carritoProductos()
    {
        return $this->belongsToMany(CarritoProducto::class);
    }

    public function pedidosProductos()
    {
        return $this->belongsToMany(PedidoPrductos::class);
    }

}
