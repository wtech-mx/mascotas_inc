<?php

namespace App\Http\Controllers;

use App\Models\Alertas;
use App\Models\Costosfijos;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Arr;
class CostosfijosController extends Controller
{
    public function create(Request $request)
    {
        $costos = new Costosfijos;
        $costos -> nombre = $request->get('nombre');
        $costos -> costo = $request->get('costo');

        $costos->save();

        Session::flash('create', 'Se ha creado sus datos con exito');
        return redirect()->back();
    }

    public function update_costos(Request $request,$id)
    {

        $costos = Costosfijos::find($id);
        $costos -> nombre = $request->get('nombre');
        $costos -> costo = $request->get('costo');
        $costos->update();

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->back();
    }
}
