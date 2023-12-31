<?php

namespace App\Http\Controllers;

use App\Imports\ProductosImport;
use Illuminate\Http\Request;

use Codexshaper\WooCommerce\Facades\WooCommerce;
use RealRashid\SweetAlert\Facades\Alert;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Session;


class WooController extends Controller
{
    public function index(request $request){
        return view('admin.productos.index');
    }

    public function search(Request $request)
    {
        $buscar = $request->input('buscar');

        $page = $request->input('page', 1);
        $perPage = 25; // Número de productos por página que quieres obtener
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://mascotasinc.com.mx/wp-json/wc/v3/products', [
            'auth' => ['ck_3f580ed48916419561560f205b4bbf714bb4f7e3', 'cs_6c6420740ee3cb7b4efacef4a20fd1038b84382e'],
            'query' => [
                'search' => $buscar,
                'page' => $page,
                'per_page' => $perPage,
            ],
        ]);
        $total = $response->getHeaderLine(config('woocommerce.header_total'));

        $products = json_decode($response->getBody());


        $output = "";
        $output2 = "";
        if($request->ajax()){
            if ($products) {
                foreach ($products as $product) {
                    // dd($product->images[0]->src);
                    if (isset($product->images[0])) {
                        $imageSrc = $product->images[0]->src;
                        // Hacer algo con $imageSrc

                $output2 .=
                '<tr class"text-white">'.
                    '<td class="text-white text-center" style="font-size:11px;"><a data-bs-toggle="modal" type="button" data-bs-target="#edit_modal_product'.$product->id.'" style="font-size:11px;"><img src="'.$imageSrc.'" style="width:50px;"></br>'.$product->stock_quantity.'</a></td>'.
                    '<td class="text-white text-left" style="font-size:11px;">'.$product->name.'</td>'.
                    '<td class="text-white text-center" style="font-size:11px;">'.$product->sku.'</td>'.
                    '<td class="text-white text-center" style="font-size:11px;">$'.$product->price.'.0</td>'.
                    '<td class="text-white text-center" style="font-size:11px;">'.
                        '<form class="row" style="display: inline-block;margin-left: 10px;" method="POST" action="'.route('scanner_product.delete', $product->id).'" >'.
                        '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                        '<input type="hidden" name="_method" value="DELETE">'.
                        '<button  class="btn btn-sm btn-danger"  type="submit">'.
                        '<i class="fa fa-fw fa-trash"></i>'.
                        '</form>'.
                        '</button >'.
                    '</td>'.
                '</tr>'.
                '<div class="modal fade" id="edit_modal_product'.$product->id.'" tabindex="-1" aria-labelledby="edit_modal_product'.$product->id.'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h3 class="modal-title fs-5" id="exampleModalLabel">'.$product->name.'</h3>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body row">'.
                        '<form class="row" method="POST" action="'.route('scanner_product.edit', $product->id).'" >'.
                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                            '<input type="hidden" name="_method" value="PATCH">'.
                            '<div class="col-12">'.
                                '<p class="text-center">'.
                                '<a href="'.$product->permalink.'" target="_blank"><img src="'.$imageSrc.'" style="width:180px;"></a>'.
                                '</p>'.
                            '</div>'.
                            '<div class="col-12">'.
                            '<label for="name" class="form-label">Nombre</label>'.
                            '<input type="text" class="form-control" id="name" name="name" value="'.$product->name.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="price" class="form-label">Precio</label>'.
                            '<input type="number" class="form-control" id="price" name="price" value="'.$product->price.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="sale_price" class="form-label">Promoción</label>'.
                            '<input type="number" class="form-control" id="sale_price" name="sale_price" value="'.$product->sale_price.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="sku" class="form-label">SKU</label>'.
                            '<input type="text" class="form-control" id="sku" name="sku" value="'.$product->sku.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="stock_quantity" class="form-label">Stock</label>'.
                            '<input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="'.$product->stock_quantity.'">'.
                            '</div>'.
                            '<button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>'.
                            '<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>'.
                        '</form>'.
                    '</div>'.
                  '</div>'.
                '</div>';
                }

                $output =
                '<div class="table-responsive">'.
                '<table class="table table-flush" id="myTable">'.
                    '<thead class="text-center">'.
                        '<tr class="tr_checkout text-white">'.
                        '<th class="text-center">Imagen</th>'.
                        '<th class="text-left">Nombre</th>'.
                        '<th class="text-center">Sku</th>'.
                        '<th class="text-center">Precio</th>'.
                        '<th class="text-center">Acciones</th>'.
                        '</tr>'.
                    '</thead>'.
                    '<tbody>'.
                    $output2 .
                    '</tbody>'.
                '</table>'.
                '</div>';
            }
        }

        }
        return response()->json($output);

    }

    public function store(Request $request){

        $dominio = $request->getHost();

        if($dominio == 'pv.mascotasinc.com.mx'){
            $fotos_bicis = base_path('../public_html/pv.mascotasinc.com.mx/productos_fotos');
            $img_fondo = base_path('../public_html/pv.mascotasinc.com.mx/cursos/fondo.png');
            $tipografia = base_path('../public_html/pv.mascotasinc.com.mx/assets/user/fonts/LeelaUIb.ttf');

        }else{
            $fotos_bicis = public_path() . '/productos_fotos';
            $img_fondo = public_path('cursos/fondo.png');
            $tipografia = public_path('assets/user/fonts/LeelaUIb.ttf');
        }


        if ($request->hasFile("image")) {
            $file = $request->file('image');
            $path = $fotos_bicis;
            $fileName = uniqid() . $file->getClientOriginalName();

            $image = Image::make($file);

            $background = Image::make($img_fondo);

            // Redimensionar la imagen a un tamaño más grande
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $imageWithBackground = $background->insert($image, 'center');
            $text = wordwrap("-", 25, "\n", true);
            // Obtener la imagen de fondo con el tamaño adecuado
            $backgroundResized = $background->resizeCanvas($imageWithBackground->getWidth(), $imageWithBackground->getHeight());



            // Guardar la imagen resultante
            $backgroundResized->save($path.'/'.$fileName);


            $ruta_completa = 'http://pv.mascotasinc.com.mx/productos_fotos/' . $fileName;
        }

        if($request->get('categoria') == 20 or $request->get('categoria') == 21 or $request->get('categoria') == 22 or $request->get('categoria') == 18){
            $data = [
                'name' => $request->get('description'),
                'type' => 'simple',
                'price' => $request->get('total'),
                'regular_price' => $request->get('total'),
                'sku' => $request->get('sku'),
                "manage_stock" => true,
                'stock_quantity' => $request->get('stock_quantity'),
                'description' => $request->get('description'),
                'short_description' => $request->get('description'),
                'images' => [
                    [
                        'src'=>  $ruta_completa
                    ],
                ],
                'categories' => [
                    [
                        'id' => $request->get('categoria'),
                    ],
                    [
                        'id' => 17,
                    ],
                ],
                'meta_data' => [
                    0 => [
                        "key"=> "id_proveedor",
                        "value"=> number_format(floatval($request->get('id_proveedor'))),
                    ],
                    2 => [
                        "key"=> "proveedor",
                        "value"=> $request->get('nombre_del_proveedor'),
                    ],
                    4 => [
                        "key"=> "costo",
                        "value"=> number_format(floatval($request->get('costo'))),
                    ],
                    6 => [
                        "key"=> "margen",
                        "value"=> number_format(floatval($request->get('margen'))),
                    ],
                    8 => [
                        "key"=> "utilidad",
                        "value"=> number_format(floatval($request->get('margen'))),
                    ],
                    10 => [
                        "key"=> "costo_variable",
                        "value"=> number_format(floatval($request->get('costo_variable'))),
                    ],
                    12 => [
                        "key"=> "subtotal",
                        "value"=> number_format(floatval($request->get('subtotal'))),
                    ],
                    14 => [
                        "key"=> "iva",
                        "value"=> number_format(floatval($request->get('iva'))),
                    ],
                ]
            ];
        }elseif($request->get('categoria') == 19 or $request->get('categoria') == 23){
            $data = [
                'name' => $request->get('description'),
                'type' => 'simple',
                'price' => $request->get('total'),
                'regular_price' => $request->get('total'),
                'sku' => $request->get('sku'),
                "manage_stock" => true,
                'stock_quantity' => $request->get('stock_quantity'),
                'description' => $request->get('description'),
                'short_description' => $request->get('description'),
                'images' => [
                    [
                        'src'=>  $ruta_completa
                    ],
                ],
                'categories' => [
                    [
                        'id' => $request->get('categoria'),
                    ],
                    [
                        'id' => 16,
                    ],
                ],
                'meta_data' => [
                    0 => [
                        "key"=> "id_proveedor",
                        "value"=> number_format(floatval($request->get('id_proveedor'))),
                    ],
                    2 => [
                        "key"=> "proveedor",
                        "value"=> $request->get('nombre_del_proveedor'),
                    ],
                    4 => [
                        "key"=> "costo",
                        "value"=> number_format(floatval($request->get('costo'))),
                    ],
                    6 => [
                        "key"=> "margen",
                        "value"=> number_format(floatval($request->get('margen'))),
                    ],
                    8 => [
                        "key"=> "utilidad",
                        "value"=> number_format(floatval($request->get('margen'))),
                    ],
                    10 => [
                        "key"=> "costo_variable",
                        "value"=> number_format(floatval($request->get('costo_variable'))),
                    ],
                    12 => [
                        "key"=> "subtotal",
                        "value"=> number_format(floatval($request->get('subtotal'))),
                    ],
                    14 => [
                        "key"=> "iva",
                        "value"=> number_format(floatval($request->get('iva'))),
                    ],
                ]
            ];
        }elseif($request->get('categoria') == 26){
            $data = [
                'name' => $request->get('name2'),
                'type' => 'simple',
                'price' => $request->get('precio-ml'),
                'regular_price' => $request->get('precio-ml'),
                'sku' => $request->get('sku2'),
                "manage_stock" => true,
                'stock_quantity' => $request->get('stock_quantity2'),
                'description' => $request->get('description2'),
                'short_description' => $request->get('description2'),
                'images' => [
                    [
                        'src'=>  $ruta_completa
                    ],
                ],
                'categories' => [
                    [
                        'id' => $request->get('categoria'),
                    ],
                    [
                        'id' => 16,
                    ],
                ],
                'meta_data' => [
                    0 => [
                        "key"=> "id_proveedor",
                        "value"=> number_format(floatval($request->get('id_proveedor'))),
                    ],
                    2 => [
                        "key"=> "proveedor",
                        "value"=> $request->get('nombre_del_proveedor'),
                    ],
                    4 => [
                        "key"=> "costo",
                        "value"=> number_format(floatval($request->get('costo2'))),
                    ],
                    11 => [
                        "key"=> "iva_acre",
                        "value"=> number_format(floatval($request->get('iva-acre'))),
                    ],
                    13 => [
                        "key"=> "costo_sin_iva",
                        "value"=> number_format(floatval($request->get('costo-sin-iva'))),
                    ],
                    15 => [
                        "key"=> "cost_unit",
                        "value"=> number_format(floatval($request->get('cost-unit'))),
                    ],
                    17 => [
                        "key"=> "cost_base",
                        "value"=> number_format(floatval($request->get('cost-base'))),
                    ],
                    19 => [
                        "key"=> "valor_venta",
                        "value"=> number_format(floatval($request->get('valor-venta'))),
                    ],
                    21 => [
                        "key"=> "costo_integrado",
                        "value"=> number_format(floatval($request->get('costo-integrado'))),
                    ],
                    23 => [
                        "key"=> "costo_ml",
                        "value"=> number_format(floatval($request->get('costo-ml'))),
                    ],
                    25 => [
                        "key"=> "precio_ml",
                        "value"=> number_format(floatval($request->get('precio-ml'))),
                    ],
                ]
            ];
        }



        //  dd($data);

        $newProduct = Product::create($data);

         Alert::success('Producto creado', 'Se ha guardado con exito');
         return redirect()->back();

    }

    public function import_products(Request $request)
    {
        Excel::import(new ProductosImport,request()->file('file'));

        return redirect()->back()->with('success', 'Creado con exito');
    }
}
