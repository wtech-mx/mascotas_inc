<?php

namespace App\Http\Controllers;

use App\Models\TallerProductos;
use App\Models\Taller;
use App\Models\Cliente;
use Codexshaper\WooCommerce\Facades\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ScannerController extends Controller
{
    public function index(){

        return view('admin.scanner.index');
    }

    public function index_products(){
        // $newProduct = Product::get();
        // dd($newProduct);
        return view('admin.scanner.index_product');
    }


    public function search(Request $request){


        if($request->ajax()){
            $output="";

            $products = Taller::where('folio', '=', $request->search)->first();
            $taller_productos = TallerProductos::where('id_taller','=',$products->id)->get();


            if ($products->estatus == 1 ) {
                $products->estatus = 'Procesando';
            }elseif ($products->estatus == 2) {
                $products->estatus = 'En Espera';
            }elseif ($products->estatus == 3) {
                $products->estatus = 'Realizado';
            }elseif ($products->estatus == 4) {
                $products->estatus = 'Cancelado';
            }elseif ($products->estatus == 0) {
                $products->estatus = 'R ingresado';
            }elseif ($products->estatus == 5) {
                $products->estatus = 'Pagado';
            }

            //  foreach($taller_productos as $taller_producto){

            //  }

            if($products){
                $output.=
                '<div class="row">'.
                    '<div class="col-12">'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Folio:</strong>'.$products->folio.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Estatus:</strong>'.$products->estatus.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Cliente:</strong>'.$products->Cliente->nombre.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Telefono:</strong><a https://api.whatsapp.com/send?phone=521'.$products->Cliente->telefono.'"></a>'.$products->Cliente->telefono.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Fecha:</strong>'.$products->fecha.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Bicicleta:</strong>  '.$products->marca.'-'.$products->modelo.'-'.$products->rodada.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Observaciones:</strong>'.$products->observaciones.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Precio del servicio:</strong>'.$products->precio_servicio.'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Saldo a favor:</strong>$'.$products->subtoral.'.0</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Total:</strong>$'.$products->total.'.0</p>'.
                    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_service'.$products->id.'">Editar</button>'.
                    '</div>'.
                '</div>'.
                '<div class="modal fade" id="edit_modal_service'.$products->id.'" tabindex="-1" aria-labelledby="edit_modal_service'.$products->id.'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h1 class="modal-title fs-5" id="exampleModalLabel">'.$products->Cliente->nombre.'</h1>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body">'.
                        '<form class="row" method="POST" action="'.route('scanner_servicio.edit', $products->id).'" >'.
                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                            '<input type="hidden" name="_method" value="PATCH">'.
                            '<div class="col-12">'.
                                '<p class="text-center">'.
                                '<img src="'.asset('fotos_bicis/'.$products->foto1).'" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="'.asset('fotos_bicis/'.$products->foto2).'" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="'.asset('fotos_bicis/'.$products->foto3).'" style="width:90px;border-radius: 19px; margin-top: 1rem;"><img src="'.asset('fotos_bicis/'.$products->foto4).'" style="width:90px;border-radius: 19px; margin-top: 1rem;">'.
                                '</p>'.
                            '</div>'.
                            '<div class="col-12">'.
                            '<label for="name" class="form-label">Estatus</label>'.
                            '<select class="form-select" name="estado">'.
                                '<option selected >'.$products->estatus.'</option>'.
                                '<option value="1">Procesando</option>'.
                                '<option value="2">En Espera</option>'.
                                '<option value="3">Realizado</option>'.
                                '<option value="4">Cancelado</option>'.
                                '<option value="0">R ingresado</option>'.
                                '<option value="5">Pagado</option>'.
                            '</select>'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="price" class="form-label">Marca</label>'.
                            '<input type="text" class="form-control" id="marca" name="marca" value="'.$products->marca.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="sale_price" class="form-label">Modelo</label>'.
                            '<input type="text" class="form-control" id="modelo" name="modelo" value="'.$products->modelo.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="sku" class="form-label">Rodada</label>'.
                            '<input type="text" class="form-control" id="rodada" name="rodada" value="'.$products->rodada.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="Costo del servicio" class="form-label">Precio del servicio</label>'.
                            '<input type="number" class="form-control" id="precio_servicio" name="precio_servicio" value="'.$products->precio_servicio.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="Saldo a Favor" class="form-label">Saldo a Favor</label>'.
                            '<input type="number" disabled class="form-control" id="subtotal" name="subtotal" value="'.$products->subtotal.'">'.
                            '</div>'.
                            '<div class="col-4">'.
                            '<label for="Total" class="form-label">Total</label>'.
                            '<input type="number" class="form-control" id="total" name="total" value="'.$products->total.'">'.
                            '</div>'.
                            '<button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>'.
                            '<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>'.
                        '</form>'.
                    '</div>'.
                  '</div>'.
                '</div>';
                return Response($output);
            }
        }
    }



    public function edit_servicio(Request $request, $id){
        $servicio = Taller::find($id);
        $servicio->marca = $request->get('marca');
        $servicio->modelo = $request->get('modelo');
        $servicio->rodada = $request->get('rodada');
        $servicio->precio_servicio = $request->get('precio_servicio');
        $servicio->subtotal = $request->get('subtotal');
        $servicio->total = $request->get('total');
        $servicio->save(); // Guarda los cambios en la base de datos
        Alert::success('Servicio Editado', 'Se ha editado con exito');
        return redirect()->back();
    }

    public function search_product(Request $request){

        if($request->ajax()){

            $output="";

            $products = Product::where('sku', '=', $request->search)->first();
            // $cliente = $products->Cliente()->with('usuario')->get();
             $prb = $prb = $products['meta_data'];
             //dd($products);
            if($products['meta_data'][0]->key == "id_proveedor"){
                $id_proveedor = $products['meta_data'][0]->value;
                $nombre_del_proveedor = $products['meta_data'][1]->value;
                $costo = $products['meta_data'][2]->value;
                $margen = $products['meta_data'][3]->value;
                $utilidad = $products['meta_data'][4]->value;
                $costo_variable = $products['meta_data'][5]->value;
                $subtotal = $products['meta_data'][6]->value;
                $iva = $products['meta_data'][7]->value;

            }

            if(isset($id_proveedor)){
                // tu código aquí si $id_proveedor está definido
              } else {
                $id_proveedor = "";
              }

              if(isset($nombre_del_proveedor)){
                // tu código aquí si $nombre_del_proveedor está definido
              } else {
                $nombre_del_proveedor = "";
              }

              if(isset($costo)){
                // tu código aquí si $costo está definido
              } else {
                $costo = 0;
              }

              if(isset($margen)){
                // tu código aquí si $margen está definido
              } else {
                $margen = 0;
              }
              if(isset($utilidad)){
                // tu código aquí si $utilidad está definido
              } else {
                $utilidad = 0;
              }
              if(isset($costo_variable)){
                // tu código aquí si $costo_variable está definido
              } else {
                $costo_variable = 0;
              }
              if(isset($subtotal)){
                // tu código aquí si $subtotal está definido
              } else {
                $subtotal = 0;
              }
              if(isset($iva)){
                // tu código aquí si $iva está definido
              } else {
                $iva = 0;
              }

            if($products){
                $output.=
                '<div class="row">'.
                    '<div class="col-12">'.
                    '<a href="'.$products['permalink'].'" target="_blank"><img src="'.$products['images'][0]->src.'" style="width:100px;"></a>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Nombre:</strong>'.$products['name'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Precio:</strong>'.$products['price'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Promocion:</strong>'.$products['sale_price'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">SKU:</strong>'.$products['sku'].'</p>'.
                    '<p class="respuesta_qr_info"><strong class="strong_qr_res">Stock:</strong>'.$products['stock_quantity'].'</p>'.
                    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_modal_product'.$products['id'].'">Editar</button>'.
                    '</div>'.
                '</div>'.
                '<div class="modal fade" id="edit_modal_product'.$products['id'].'" tabindex="-1" aria-labelledby="edit_modal_product'.$products['id'].'Label" aria-hidden="true">'.
                '<div class="modal-dialog modal-dialog-centered">'.
                  '<div class="modal-content">'.
                    '<div class="modal-header">'.
                      '<h1 class="modal-title fs-5" id="exampleModalLabel">'.$products['name'].'</h1>'.
                      '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'.
                    '</div>'.
                    '<div class="modal-body">'.
                        '<form class="row" method="POST" action="'.route('scanner_product.edit', $products['id']).'" >'.
                            '<input type="hidden" name="_token" value="'.csrf_token().'">'.
                            '<input type="hidden" name="_method" value="PATCH">'.
                            '<div class="col-12">'.
                                '<p class="text-center">'.
                                '<a href="'.$products['permalink'].'" target="_blank"><img src="'.$products['images'][0]->src.'" style="width:200px;"></a>'.
                                '</p>'.
                            '</div>'.
                            '<div class="col-12">'.
                            '<label for="name" class="form-label">Nombre</label>'.
                            '<input type="text" class="form-control" id="name" name="name" value="'.$products['name'].'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="price" class="form-label">Precio</label>'.
                            '<input type="number" class="form-control" id="price" name="price" value="'.$products['price'].'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="sale_price" class="form-label">Promoción</label>'.
                            '<input type="number" class="form-control" id="sale_price" name="sale_price" value="'.$products['sale_price'].'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="sku" class="form-label">SKU</label>'.
                            '<input type="text" class="form-control" id="sku" name="sku" value="'.$products['sku'].'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="stock_quantity" class="form-label">Stock</label>'.
                            '<input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="'.$products['stock_quantity'].'">'.
                            '</div>'.
                            '<div class="col-6">'.
                            '<label for="id_proveedor" class="form-label">Id Prove</label>'.
                            '<input type="text" class="form-control" id="id_proveedor" name="id_proveedor" value="'.$id_proveedor.'">'.
                            '</div>'.
                            '<div class="col-6">'.
                            '<label for="proveedor" class="form-label">Proveedor</label>'.
                            '<input type="text" class="form-control" id="proveedor" name="proveedor" value="'.$nombre_del_proveedor.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="costo" class="form-label">costo</label>'.
                            '<input type="text" class="form-control" id="costo" name="costo" value="'.$costo.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="margen" class="form-label">margen</label>'.
                            '<input type="text" class="form-control" id="margen" name="margen" value="'.$margen.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="utilidad" class="form-label">utilidad</label>'.
                            '<input type="text" class="form-control" id="utilidad" name="utilidad" value="'.$utilidad.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="costo_variable" class="form-label">costo_variable</label>'.
                            '<input type="text" class="form-control" id="costo_variable" name="costo_variable" value="'.$costo_variable.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="subtotal" class="form-label">subtotal</label>'.
                            '<input type="text" class="form-control" id="subtotal" name="subtotal" value="'.$subtotal.'">'.
                            '</div>'.
                            '<div class="col-3">'.
                            '<label for="iva" class="form-label">iva</label>'.
                            '<input type="text" class="form-control" id="iva" name="iva" value="'.$iva.'">'.
                            '</div>'.
                            '<button id="save-btn" type="submit" class="btn btn-primary mt-2">Guardar cambios</button>'.
                            '<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cerrar</button>'.
                        '</form>'.
                    '</div>'.
                  '</div>'.
                '</div>';
                return Response($output);
            }
        }
    }

    public function edit_product(Request $request,$id)
    {
        $products = Product::find($id);
        $products->name = $request->get('name');
        $products->price = $request->get('price');
        $products->sale_price = $request->get('sale_price');
        $products->sku = $request->get('sku');
        $products->stock_quantity = $request->get('stock_quantity');
        $products->id_proveedor = $request->get('id_proveedor');
        $products->nombre_del_proveedor = $request->get('nombre_del_proveedor');
        $products->costo = $request->get('costo');
        $products->clave_mayorista = $request->get('clave_mayorista');

        $data       = [
            'name' => $products->name ,
            'price' => $products->price ,
            'regular_price' => $products->price ,
            'sale_price' => $products->sale_price,
            'sku' => $products->sku,
            'stock_quantity' => $products->stock_quantity,
            "meta_data" => [
                3 => [
                  "key"=> "id_proveedor",
                  "value"=> $products->id_proveedor,
                ],
                4 => [
                  "key"=> "nombre_del_proveedor",
                  "value"=> $products->nombre_del_proveedor,
                ],
                5 => [
                  "key"=> "costo",
                  "value"=> $products->costo,
                ],
                6 => [
                  "key"=> "clave_mayorista",
                  "value"=> $products->clave_mayorista,
                ]
              ]
        ];

        $product = Product::update($id, $data);
        Alert::success('Producto Editado', 'Se ha editado con exito');
        return redirect()->back();
    }

    public function store(request $request){

        return view('admin.scanner.index');
    }

    public function delete_product(Request $request,$id){
        $options = ['force' => true]; // Set force option true for delete permanently. Default value false

        $product = Product::delete($id, $options);
        Alert::warning('Producto Elimindo', 'Se ha eliminados con exito');
        return redirect()->back();
    }
}
