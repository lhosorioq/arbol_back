<?php

namespace App\Models;
use App\Models\NodoArbol;

use function Psy\debug;

class ArbolBinario {

    public $raiz;
    public $datos;

    function __construct() {
        $this->raiz = null;
    }

    function addNodo($dato) {
        $newNodo = new NodoArbol($dato);

        if ( $this->raiz == null ) {
            $this->raiz = $newNodo;
            return ;
        }

        $nodoAux = $this->raiz;
        $padre = NULL;

        while(true) {
            $padre = $nodoAux;
            if ( intval($dato->nmcliente) <= intval($nodoAux->dato->nmcliente)) {
                $nodoAux = $nodoAux->hijoIzquierdo;
                if ( $nodoAux == null) {
                    $padre->hijoIzquierdo = $newNodo;
                    return ;
                }
            }else {
                $nodoAux = $nodoAux->hijoDerecho;
                if($nodoAux == null) {
                    $padre->hijoDerecho = $newNodo;
                    return ;
                }
            }
        }
    }

    function estaVacio() {
        return $this->raiz == null;
    }

    function getDatosInOrden(){
        $this->datos = [];
        $this->inOrden($this->raiz);
        return $this->datos;
    }

    function getDatosPreOrden(){
        $this->datos = [];
        $this->preOrden($this->raiz);
        return $this->datos;
    }

    function inOrden($raiz) {
        if($raiz == null) {
            return ;
        }
        $this->inOrden($raiz->hijoIzquierdo);
        $this->datos[] = $raiz->dato;
        $this->inOrden($raiz->hijoDerecho);
    }

    function preOrden($raiz) {
        if($raiz == null) {
            return ;
        }
        $this->datos[] = $raiz->dato;
        $this->preOrden($raiz->hijoIzquierdo);
        $this->preOrden($raiz->hijoDerecho);
    }

    function getNodo($dato) {
        if($this->raiz == null) {
            return null;
        }
        $aux = $this->raiz;
        while($aux->dato->nmcliente->equals($dato) == false) {
            if(intval($dato) < intval($aux->dato->nmcliente)) {
                $aux = $aux->hijoIzquierdo;
            }else {
                $aux = $aux->hijoDerecho;
            }
            if($aux == null) {
                return null;
            }
        }
        return $aux->dato;
    }

    function updateNodo($cliente) {
        if($this->raiz == null) {
            return false;
        }
        $aux = $this->raiz;
        while($aux->dato->nmcliente->equals($cliente->nmcliente) == false) {
            if(intval($cliente->nmcliente) < intval($aux->dato->nmcliente)) {
                $aux = $aux->hijoIzquierdo;
            }else {
                $aux = $aux->hijoDerecho;
            }
            if($aux == null) {
                return false;
            }
        }
        $aux->dato = $cliente;
        return true;
    }

    function obtenerNodoReemplazo($nodoR) {
        $reemplazarPadre = $nodoR;
        $reemplazo = $nodoR;
        $aux = $nodoR->hijoDerecho;
        while($aux != null) {
            $reemplazarPadre = $reemplazo;
            $reemplazo = $aux;
            $aux = $aux->hijoIzquierdo;
        }
        if($reemplazo != $nodoR->hijoDerecho) {
            $reemplazarPadre->hijoIzquierdo = $reemplazo->hijoDerecho;
            $reemplazo->hijoDerecho = $nodoR->hijoDerecho;
        }
        // echo "El nodo R es " + reemplazo;
        return $reemplazo;
    }
}
