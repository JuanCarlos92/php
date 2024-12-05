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
            // Llama al método del repositorio para obtener todos los productos
            return $this->productoRepository->getAll();
            
        } catch (Exception $e) {
            throw new Exception("Error al obtener los productos: " . $e->getMessage());
        }
    }

    // Crear un nuevo producto
    public function create(ProductoDTO $productoDTO)
    {
        try {
            // Llama al método del repositorio para crear un producto, pasando un objeto ProductoDTO
            return $this->productoRepository->create($productoDTO);
        } catch (Exception $e) {
            throw new Exception("Error al crear el producto: " . $e->getMessage());
        }
    }
}
?>