<?php
require_once __DIR__ . '/../repositories/VentaRepository.php';
require_once __DIR__ . '/../models/VentaDTO.php';

class VentaService
{
    private $ventaRepository; // Almacena la instancia del repositorio

    public function __construct()
    {
        $this->ventaRepository = new VentaRepository();
    }


    // Obtener todas las ventas
    public function getAll()
    {
        try {

            return $this->ventaRepository->getAll(); // Llamar al repositorio para obtener todas las ventas

        } catch (Exception $e) {
            throw new Exception("Error en el servicio al obtener las ventas: " . $e->getMessage());
        }
    }
    // Obtener ventas por comercial
    public function getByComercial($codComercial)
    {
        try {

            return $this->ventaRepository->getByComercial($codComercial); // Llama al repositorio para obtener ventas por un comercial

        } catch (Exception $e) {
            throw new Exception("Error en el servicio al crear la venta: " . $e->getMessage());
        }
    }
     // Obtener consulta para actualizar
     public function getVentas()
     {
         try {
 
             return $this->ventaRepository->getVentas(); // Llama al repositorio para obtener ventas por un comercial
 
         } catch (Exception $e) {
             throw new Exception("Error al visualizar las ventas: " . $e->getMessage());
         }
     }

    // Crear una nueva venta
    public function create(VentaDTO $ventaDTO)
    {
        try {
            return $this->ventaRepository->create($ventaDTO); // Llama al repositorio para create

        } catch (Exception $e) {
            throw new Exception("Error al crear la venta: " . $e->getMessage());
        }

    }
    // Actualizar una venta
    public function update(VentaDTO $ventaDTO)
    {
        try {
            return $this->ventaRepository->update($ventaDTO); // Llama al repositorio para update

        } catch (Exception $e) {
            throw new Exception("Error al actualizar la venta: " . $e->getMessage());
        }
    }
    public function delete(VentaDTO $ventaDTO){
        try {
            return $this->ventaRepository->delete($ventaDTO); // Llama al repositorio para update

        } catch (Exception $e) {
            throw new Exception("Error al eliminar la venta: " . $e->getMessage());
        }
    }

}
?>