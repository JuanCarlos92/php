<?php

class ComercialDTO
{
    public $codigo;
    public $nombre;
    public $salario;
    public $hijos;
    public $fNacimiento;

    public function __construct($codigo, $nombre, $salario, $hijos, $fNacimiento)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->salario = $salario;
        $this->hijos = $hijos;
        $this->fNacimiento = $fNacimiento;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSalario($salario)
    {
        $this->salario = $salario;
    }

    public function getHijos()
    {
        return $this->hijos;
    }

    public function setHijos($hijos)
    {
        $this->hijos = $hijos;
    }

    public function getFechaNacimiento()
    {
        return $this->fNacimiento;
    }

    public function setFechaNacimiento($fNacimiento)
    {
        $this->fNacimiento = $fNacimiento;
    }
}
?>