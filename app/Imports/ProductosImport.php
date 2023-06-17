<?php

namespace App\Imports;

use App\Models\Productos;
use Codexshaper\WooCommerce\Facades\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;

class ProductosImport implements ToModel, WithHeadingRow,WithUpserts{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;

    public function uniqueBy()
    {

    }

    public function model(array $row)
    {
        $producto = new Productos([
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripcion'],
            'sku' => $row['sku'],
            'stock' => $row['stock'],
            'categoria' => $row['categoria'],
            'precio_normal' => $row['costo'],
            'iva' => $row['iva'],
            'margen' => $row['margen'],
            'utilidad' => $row['utilidad'],
            'costo_fijo' => $row['costo_fijo'],
            'subtotal' => $row['subtotal'],
            'iva_pa' => $row['iva_pa'],
            'total' => $row['total'],
        ]);

        return $producto;
    }
}
