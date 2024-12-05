<?php
require_once __DIR__ . '/../repositories/VentaRepository.php';
require_once __DIR__ . '/../models/VentaDTO.php';

class VentaService
{
    private $ventaRepository; // Variable para almacenar la instancia del repositorio de ventas

    public function __construct()
    {
        $this->ventaRepository = new VentaRepository();
    }


    //Método para obtener todas las ventas
    public function getAll()
    {
        try {
            // Llamar al método getAll() del repositorio y almacenar el resultado en $ventaDTOs
            $ventaDTOs = $this->ventaRepository->getAll();

            return $ventaDTOs; // Devolver un array de objetos VentaDTO

        } catch (Exception $e) {
            throw new Exception("Error en el servicio al obtener las ventas: " . $e->getMessage());
        }
    }


    // Crear una nueva venta
    public function create(VentaDTO $ventaDTO)
    {
        try {
            // Llama al repositorio para crear un nuevo comercial utilizando el DTO pasado como parámetro
            return $this->ventaRepository->create($ventaDTO);
        } catch (Exception $e) {
            throw new Exception("Error al crear la venta: " . $e->getMessage());
        }

    }


    // Obtener ventas por comercial
    public function getByComercial($codComercial)
    {
        try {
            // Llamar al método getByComercial() del repositorio para insertar una venta
            $this->ventaRepository->getByComercial($codComercial);
        } catch (Exception $e) {
            throw new Exception("Error en el servicio al crear la venta: " . $e->getMessage());
        }
    }
}
?>