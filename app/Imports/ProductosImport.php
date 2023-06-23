<?php

namespace App\Imports;

use App\Models\Productos;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Support\Str;
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

        $code = Str::random(4);
        $producto = new Productos([
            'nombre' => $row['nombre'],
            'descripcion' => $row['descripcion'],
            'sku' => $code,
            'stock' => 100,
            'categoria' => $row['categoria'],
            'subcategoria' => $row['subcategoria'],
            'precio_normal' => $row['costo'],
            'iva' => $row['iva'],
            'margen' => $row['margen'],
            'utilidad' => $row['utilidad'],
            'costo_fijo' => $row['costo_fijo'],
            'subtotal' => $row['subtotal'],
            'iva_pa' => $row['iva_pa'],
            'total' => $row['total'],
        ]);

        $data = [
            'name' => $row['nombre'],
            'type' => 'simple',
            'price' => number_format(floatval($row['total'])),
            'regular_price' => number_format(floatval($row['total'])),
            'sku' => $code,
            "manage_stock" => true,
            'stock_quantity' => 100,
            'description' => $row['descripcion'],
            'short_description' => $row['descripcion'],
            'categories' => [
                0 => [
                    "name"=> $row['categoria'],
                  ],
                1 => [
                    "name"=> $row['subcategoria'],
                ],
            ],
            "meta_data" => [
                0 => [
                  "key"=> "id_proveedor",
                  "value"=> $row['id_proveedor'],
                ],
                2 => [
                  "key"=> "proveedor",
                  "value"=> $row['proveedor'],
                ],
                4 => [
                  "key"=> "costo",
                  "value"=> $row['costo'],
                ],
              ]
        ];

        $newProduct = Product::create($data);

        return $producto;
    }
}
