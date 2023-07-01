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
        // Obtener el nombre del archivo sin la ruta
        $nombreArchivo = basename($nombreImagen);
        $nombreArchivo = str_replace("ñ", "n", $nombreArchivo);
        // Quitar los acentos utilizando la función iconv
        $nombreArchivo = iconv('UTF-8', 'ASCII//TRANSLIT', $nombreArchivo);
        // Eliminar espacios duplicados en el nombre de la imagen
        $nombreArchivo = preg_replace('/\s+/', ' ', $nombreArchivo);
        $nombreImagen = str_replace(' ', '-', $nombreArchivo);
        $nombreImagen = str_replace('.jpg', '-scaled.jpg', $nombreImagen);
        $ruta = "http://mascotasinc.com.mx/wp-content/uploads/2023/06/" . $nombreImagen;
        $fechaActual = Carbon::now()->toDateTimeString();

        $iva_prin = $row['costo_prin'] * 0.16;
        $costo_prin = $row['costo_prin'] - $iva_prin;
        $utilidad = $costo_prin * $row['margen'];
        $subtotal = $costo_prin + $utilidad + $row['costo_variable'];
        $iva = $subtotal * 0.16;
        $total = $subtotal + $iva;

        if($row['categoria'] == 'gato'){
            $categoria = 27;
        }elseif($row['categoria'] == 'perro y gato'){
            $categoria = 15;
        }elseif($row['categoria'] == 'tortuga'){
            $categoria = 30;
        }elseif($row['categoria'] == 'pez'){
            $categoria = 29;
        }elseif($row['categoria'] == 'mobiliario'){
            $categoria = 31;
        }elseif($row['categoria'] == 'hamster'){
            $categoria = 28;
        }elseif($row['categoria'] == 'equipo'){
            $categoria = 32;
        }else{
            $categoria = 15;
        }

        if($row['subcategoria'] == 'accesorios'){
            $subcategoria = 19;
        }elseif($row['subcategoria'] == 'juguetes'){
            $subcategoria = 21;
        }elseif($row['subcategoria'] == 'alimentos'){
            $subcategoria = 33;
        }elseif($row['subcategoria'] == 'higiene'){
            $subcategoria = 23;
        }elseif($row['subcategoria'] == 'ropa'){
            $subcategoria = 18;
        }elseif($row['subcategoria'] == 'estetica'){
            $subcategoria = 34;
        }elseif($row['subcategoria'] == 'mobiliario'){
            $subcategoria = 31;
        }elseif($row['subcategoria'] == 'equipo'){
            $subcategoria = 32;
        }

        $code = Str::random(4);
        if($row['codigo_tienda'] == ""){
            $sku = $code;
        }else{
            $sku = $row['codigo_tienda'];
        }

        if (!Productos::where('sku', $sku)->exists() && @getimagesize($ruta)) {
            $producto = new Productos([
                'nombre' => $row['descripcion'],
                'descripcion' => $row['descripcion'],
                'sku' => $sku,
                'stock' => $row['unidades'],
                'categoria' => $row['categoria'],
                'subcategoria' => $row['subcategoria'],
                'iva' => $iva,
                'margen' => $row['margen'],
                'utilidad' => $row['utilidad'],
                'costo_fijo' => $row['costo_variable'],
                'subtotal' =>  $subtotal,
                'iva_pa' => $iva,
                'total' => $total,
                'imagen' => $row['foto'],
            ]);


            $data = [
                'name' => $row['descripcion'],
                'type' => 'simple',
                'price' => number_format(floatval($total)),
                'regular_price' => number_format(floatval($total)),
                'sku' => strval($sku),
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
                        "name"=> number_format(floatval($categoria)),
                    ],
                    1 => [
                        "name"=> number_format(floatval($subcategoria)),
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
                    "value"=> number_format(floatval($costo_prin)),
                    ],
                    6 => [
                        "key"=> "margen",
                        "value"=> "0.3",
                    ],
                    8 => [
                        "key"=> "utilidad",
                        "value"=> number_format(floatval($utilidad)),
                    ],
                    10 => [
                        "key"=> "costo_variable",
                        "value"=> number_format(floatval($row['costo_variable'])),
                    ],
                    12 => [
                        "key"=> "subtotal",
                        "value"=> number_format(floatval($subtotal)),
                    ],
                    14 => [
                        "key"=> "iva",
                        "value"=> number_format(floatval($iva)),
                    ],
                ]
            ];

            $newProduct = Product::create($data);


            return $producto;
        }
    }
}
