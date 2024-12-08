<?php

class VentaDTO
{
    public $codComercial;
    public $refProducto;
    public $cantidad;
    public $fecha;
    public $nombreComercial;
    public $nombreProducto;
    public $descripcionProducto;


    public function __construct()
    {

    }

    public function getNombreComercial()
    {
        return $this->nombreComercial;
    }

    public function setNombreComercial($nombreComercial)
    {
        $this->nombreComercial = $nombreComercial;
    }

    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    }

    public function getCodComercial()
    {
        return $this->codComercial;
    }

    public function setCodComercial($codComercial)
    {
        $this->codComercial = $codComercial;
    }

    public function getRefProducto()
    {
        return $this->refProducto;
    }

    public function setRefProducto($refProducto)
    {
        $this->refProducto = $refProducto;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    public function getDescripcionProducto()
    {
        return $this->descripcionProducto;
    }
    public function setDescripcionProducto($descripcionProducto)
    {
        $this->descripcionProducto = $descripcionProducto;
    }

}
?>