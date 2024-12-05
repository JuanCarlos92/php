<?php

class VentaDTO
{
    public $codComercial;
    public $refProducto;
    public $cantidad;
    public $fecha;

    public function __construct($codComercial, $refProducto, $cantidad, $fecha)
    {
        $this->codComercial = $codComercial;
        $this->refProducto = $refProducto;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
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
}

?>