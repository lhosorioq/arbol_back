<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use App\Models\ArbolBinario;

class ClienteController extends Controller
{
    private $arbolBinario;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return \response($clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nmcliente'=> 'required',
        //     'dsnombres'=> 'required',
        //     'dsapellidos'=> 'required',
        //     'dsdireccion'=> 'required',
        //     'dscorreo'=> 'required',
        //     'cdtelefono'=> 'required'
        // ]);
        $cliente = Cliente::create($request->all());
        return \response($cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return \response($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id)->update($request->all());
        return \response($cliente);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return \response("El cliente se ha eliminado");
    }


    // Nuevos metodos que reemplazan los creados por defecto para API.

	function getArbolInOrden(){
		return $this->getArbolBinarioInOrden();
	}

	function getArbolPreOrden(){
		return $this->getArbolBinarioPreOrden();
	}

	function getNodoByNmcliente($nmcliente){
		return $this->getNodo($nmcliente);
	}

	function postAddNodo(Request $request){
		$newCliente = new Cliente($request->all());
		$this->addNodo($newCliente);
        $cliente = Cliente::create($request->all());
		return \response($cliente);
	}

    function putEditNodo(Request $request, $id)
    {
		$nodoArbol = $this->getNodo($id);
        if($nodoArbol != null) {
            $cliente = new Cliente($request->all());
            $this->actualizarNodo($cliente);
            $cliente = Cliente::find($id)->update($request->all());
        }
        return \response($cliente);
	}



	// servicios
	function cargarArbol() {
		$this->arbolBinario = new ArbolBinario();
		$clientes = Cliente::all();
		foreach($clientes as $cliente) {
			$this->arbolBinario->addNodo($cliente);
		}
	}

	function addNodo($cliente) {
		$this->cargarArbol();
		$this->arbolBinario->addNodo($cliente);
	}

	function getArbolBinarioInOrden(){
		$this->cargarArbol();
		return $this->arbolBinario->getDatosInOrden();
	}

	function getArbolBinarioPreOrden(){
		$this->cargarArbol();
		return $this->arbolBinario->getDatosPreOrden();
	}

	function getNodo($nmcliente) {
		$this->cargarArbol();
		return $this->arbolBinario->getNodo($nmcliente);
	}

	function actualizarNodo($cliente) {
		$this->cargarArbol();
		return $this->arbolBinario->updateNodo($cliente);
	}

}

