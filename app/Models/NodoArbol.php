<?php
namespace App\Models;

class NodoArbol {

    public $dato;
    public $hijoIzquierdo;
    public $hijoDerecho;
    public $nombre;

    function __construct($cliente) {
        $this->dato = $cliente;
        $this->hijoDerecho = null;
        $this->hijoIzquierdo = null;
    }
}
