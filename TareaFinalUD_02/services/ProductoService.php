<?php
require_once __DIR__ . '/../repositories/ProductoRepository.php';
require_once __DIR__ . '/../models/ProductoDTO.php';

class ProductoService
{
    private $productoRepository;

    // Constructor que inicializa el repositorio de productos
    public function __construct()
    {
        $this->productoRepository = new ProductoRepository();
    }

    // Obtener todos los productos
    public function getAll()
    {
        try {

            return $this->productoRepository->getAll(); // Llama al método del repositorio para obtener todos los productos

        } catch (Exception $e) {
            throw new Exception("Error al obtener los productos: " . $e->getMessage());
        }
    }
    //  Obtener consulta ref + nombre + descrip
    public function getReferencia_Nombre()
    {
        try {

            return $this->productoRepository->getReferencia_Nombre(); // Llamar al método del repositorio para obtener ref + nombre + descrip

        } catch (Exception $e) {
            throw new Exception("Error en el servicio al obtener las ventas: " . $e->getMessage());
        }
    }

    // Crear un nuevo producto
    public function create(ProductoDTO $productoDTO)
    {
        try {

            return $this->productoRepository->create($productoDTO); // Llama al método del repositorio para crear

        } catch (Exception $e) {
            throw new Exception("Error al crear el producto: " . $e->getMessage());
        }
    }
    public function update(ProductoDTO $productoDTO)
    {
        try {
            return $this->productoRepository->update($productoDTO); // Llama al repositorio para actualizar

        } catch (Exception $e) {
            throw new Exception("Error al actualizar el producto: " . $e->getMessage());
        }
    }
    public function delete(ProductoDTO $productoDTO)
    {
        try {
            return $this->productoRepository->delete($productoDTO); // Llama al repositorio para eliminar

        } catch (Exception $e) {

            throw new Exception("Error al eliminar el producto: " . $e->getMessage());
        }
    }
}
?>