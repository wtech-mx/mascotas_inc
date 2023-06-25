<!-- Modal -->
<div class="modal fade" id="modal_creat_product" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-productos-tab" data-bs-toggle="pill" data-bs-target="#pills-productos" type="button" role="tab" aria-controls="pills-productos" aria-selected="true">Productos</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-medicamento-tab" data-bs-toggle="pill" data-bs-target="#pills-medicamento" type="button" role="tab" aria-controls="pills-medicamento" aria-selected="false">Medicamento</button>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-productos" role="tabpanel" aria-labelledby="pills-productos-tab">

                    <form method="POST" action="{{ route('product_woo.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="row">

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Nombre del producto</label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="name" name="name" >
                                </div>
                            </div>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Descripcion</label>
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom" style="margin-bottom: 1rem;">Generar </label> <br>
                                <a id="generateBtn" style="background: #003249; padding: 10px;border-radius: 9px;">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/sincronizando.png') }}" alt="">
                                </a>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">SKU </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/generate.png') }}" alt="">
                                </span>
                                <input class="form-control" type="number"  id="sku" name="sku" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Cantidad </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/cajas.png') }}" alt="">
                                </span>

                                <input class="form-control" type="number"  id="stock_quantity" name="stock_quantity" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Categoria </label>
                                <div class="input-group input-group-alternative mb-4">
                                {{-- <input class="form-control" type="text"  id="categoria" name="categoria" > --}}
                                <select class="form-select"  id="categoria" name="categoria" >
                                    <option value="0">Seleciona una Opcion</option>
                                    <option value="20">Perro accesorio </option>
                                    <option value="22">Perro higiene </option>
                                    <option value="21">Perro juguetes </option>
                                    <option value="18">Perro ropa </option>
                                    <option value="19">Gato accesorios </option>
                                    <option value="23">Gato higiene </option>
                                    <option value="25">Perro y gato higien</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">ID Proveedor </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text"  id="id_proveedor" name="id_proveedor" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Proveedor </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text"  id="nombre_del_proveedor" name="nombre_del_proveedor" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Costo </label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                        <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/dolar.png') }}" alt="">
                                    </span>

                                    <input class="form-control" type="number"  id="costo" name="costo" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">IVA </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="iva" name="iva" placeholder="IVA" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Costo Total </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="costo-total" name="costo-total" placeholder="Costo Total">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Margen</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="margen" name="margen" value="0.5">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Utilidad</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="utilidad" name="utilidad" placeholder="Utilidad">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Costo Fijo</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="valor-costo-fijo" name="valor-costo-fijo" value="41.52">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Subtotal</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="subtotal" name="subtotal" placeholder="Subtotal">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">IVA PA</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="iva-pa" name="iva-pa" placeholder="IVA_PA">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Total</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="total" name="total" placeholder="Total">
                                </div>
                            </div>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Imagen del producto</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="file"  id="image" name="image" >
                                </div>
                            </div>

                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                        </div>
                    </form>

                </div>

                <div class="tab-pane fade" id="pills-medicamento" role="tabpanel" aria-labelledby="pills-medicamento-tab">
                    <form method="POST" action="{{ route('product_woo.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="row">

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Nombre del Medicamento</label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/llantas.png') }}" alt="">
                                </span>

                                <input class="form-control" type="text"  id="name" name="name" >
                                </div>
                            </div>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Descripcion</label>
                                <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom" style="margin-bottom: 1rem;">Generar </label> <br>
                                <a id="generateBtn2" style="background: #003249; padding: 10px;border-radius: 9px;">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/sincronizando.png') }}" alt="">
                                </a>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">SKU </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/generate.png') }}" alt="">
                                </span>
                                <input class="form-control" type="number"  id="sku2" name="sku2" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Cantidad </label>
                                <div class="input-group input-group-alternative mb-4">
                                <span class="input-group-text">
                                    <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/cajas.png') }}" alt="">
                                </span>

                                <input class="form-control" type="number"  id="stock_quantity" name="stock_quantity" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Categoria </label>
                                <div class="input-group input-group-alternative mb-4">
                                {{-- <input class="form-control" type="text"  id="categoria" name="categoria" > --}}
                                <select class="form-select"  id="categoria" name="categoria" >
                                    <option value="26">Medicamento</option>
                                </select>
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">ID Proveedor </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text"  id="id_proveedor" name="id_proveedor" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Proveedor </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text"  id="nombre_del_proveedor" name="nombre_del_proveedor" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Costo </label>
                                <div class="input-group input-group-alternative mb-4">
                                    <span class="input-group-text">
                                        <img class="img_icon_form " style="width: 30px;" src="{{ asset('assets/admin/img/icons/dolar.png') }}" alt="">
                                    </span>

                                    <input class="form-control" type="number"  id="costo" name="costo" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">IVA </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="iva" name="iva" placeholder="IVA" >
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Costo Total </label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="costo-total" name="costo-total" placeholder="Costo Total">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Margen</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="margen" name="margen" value="0.5">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Utilidad</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="utilidad" name="utilidad" placeholder="Utilidad">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Costo Fijo</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="valor-costo-fijo" name="valor-costo-fijo" value="41.52">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Subtotal</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="subtotal" name="subtotal" placeholder="Subtotal">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">IVA PA</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="iva-pa" name="iva-pa" placeholder="IVA_PA">
                                </div>
                            </div>

                            <div class="col-6 form-group ">
                                <label for="" class="form-control-label label_form_custom">Total</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="text" id="total" name="total" placeholder="Total">
                                </div>
                            </div>

                            <div class="col-12 form-group ">
                                <label for="" class="form-control-label label_form_custom">Imagen del producto</label>
                                <div class="input-group input-group-alternative mb-4">
                                <input class="form-control" type="file"  id="image" name="image" >
                                </div>
                            </div>

                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                        </div>
                    </form>
                </div>

              </div>

        </div>
    </div>
</div>

<script>

const generateBtn = document.getElementById('generateBtn');
const generateBtn2 = document.getElementById('generateBtn2');

const sku = document.getElementById('sku');
const sku2 = document.getElementById('sku2');

generateBtn.addEventListener('click', function() {
  const code = generateCode(8);
  sku.value = code;
});

generateBtn2.addEventListener('click', function() {
  const code = generateCode2(8);
  sku2.value = code;
});

function generateCode(length) {
  let result = '';
  const characters = '0123456789';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

function generateCode2(length) {
  let result = '';
  const characters = '0123456789';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}

function handleClick(event) {
  event.preventDefault();
  const sku = document.getElementById('sku');
  sku.value = generateRandomCode();
}

function handleClick(event) {
  event.preventDefault();
  const sku2 = document.getElementById('sku2');
  sku2.value = generateRandomCode();
}
</script>
