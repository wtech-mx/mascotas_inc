<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'products';

    protected $fillable = [
        'nombre',
        'descripcion',
        'sku',
        'stock',
        'alerta_stock',
        'imagen',
        'categoria',
        'iva',
        'costo_total',
        'margen',
        'utilidad',
        'costo_fijo',
        'subtotal',
        'iva_pa',
        'total',
    ];
}
