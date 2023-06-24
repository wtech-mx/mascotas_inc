<?php

namespace App\Imports;

use App\Models\Productos;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;
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

        $nombreImagen = $row['foto'];
        $nombreImagen = str_replace(' ', '-', $nombreImagen);
        $nombreImagen = str_replace('.jpg', '-scaled.jpg', $nombreImagen);
        $ruta = "http://mascotasinc.com.mx/wp-content/uploads/2023/06/" . $nombreImagen;
        $fechaActual = Carbon::now()->toDateTimeString();

        $code = Str::random(4);
        $producto = new Productos([
            'nombre' => $row['descripcion'],
            'descripcion' => $row['descripcion'],
            'sku' => $code,
            'stock' => $row['unidades'],
            'categoria' => $row['categoria'],
            'subcategoria' => $row['subcategoria'],
            'iva' => $row['iva'],
            'margen' => $row['margen'],
            'utilidad' => $row['utilidad'],
            'costo_fijo' => $row['costo_variable'],
            'subtotal' => $row['subtotal'],
            'iva_pa' => $row['iva'],
            'total' => $row['total'],
            'imagen' => $row['foto'],
        ]);

        $data = [
            'name' => $row['descripcion'],
            'type' => 'simple',
            'price' => number_format(floatval($row['total'])),
            'regular_price' => number_format(floatval($row['total'])),
            'sku' => $row['codigo_tienda'],
            "manage_stock" => true,
            'stock_quantity' => $row['unidades'],
            'description' => $row['descripcion'],
            'short_description' => $row['descripcion'],
            'images' => [
                [
                    'src'=> $ruta
                ],
            ],
            'categories' => [
                0 => [
                    "name"=> $row['categoria'],
                  ],
                1 => [
                    "name"=> $row['subcategoria'],
                ],
            ],
            'meta_data' => [
                0 => [
                  "key"=> "id_proveedor",
                  "value"=> number_format(floatval($row['codigo_tienda'])),
                ],
                2 => [
                  "key"=> "proveedor",
                  "value"=> $row['tienda'],
                ],
                4 => [
                  "key"=> "costo",
                  "value"=> number_format(floatval($row['costo'])),
                ],
                6 => [
                    "key"=> "margen",
                    "value"=> number_format(floatval($row['margen'])),
                ],
                8 => [
                    "key"=> "utilidad",
                    "value"=> number_format(floatval($row['utilidad'])),
                ],
                10 => [
                    "key"=> "costo_variable",
                    "value"=> number_format(floatval($row['costo_variable'])),
                ],
                12 => [
                    "key"=> "subtotal",
                    "value"=> number_format(floatval($row['subtotal'])),
                ],
                14 => [
                    "key"=> "iva",
                    "value"=> number_format(floatval($row['iva'])),
                ],
            ]
        ];

        $newProduct = Product::create($data);


        return $producto;
    }
}
