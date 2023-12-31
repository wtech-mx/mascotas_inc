<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Codexshaper\WooCommerce\Facades\WooCommerce;
use Codexshaper\WooCommerce\Facades\Customer ;
use Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Cliente::orderBy('id','DESC')->get();

        return view('admin.cliente.index', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $random = rand();
        $nombreram =  $request->input('nombre').$random;

        $data = [
            'email' => $request->get('email'),
            'first_name' => $request->get('nombre'),
            'last_name' => $request->get('nombre'),
            'username' => $nombreram,
        ];

        $newCustomer= Customer ::create($data);

        $cliente = new Cliente;
        $cliente->nombre = $request->get('nombre');
        $cliente->email = $request->get('email');
        $cliente->telefono = $request->get('telefono');
        $cliente->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('success', 'Cliente Creado.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $client, $id)
    {

        $client = Cliente::find($id);
        $input = $request->all();
        $client->update($input);

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('edit', 'Cliente Actualizado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $client = Cliente::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('clients.index')
            ->with('delete', 'Cliente Eliminado');
    }
}
