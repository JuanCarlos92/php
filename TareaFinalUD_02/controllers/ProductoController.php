<?php
require_once __DIR__ . '/../services/ProductoService.php';
require_once __DIR__ . '/../models/ProductoDTO.php';

class ProductoController
{
    private $productoService;

    public function __construct()
    {
        $this->productoService = new ProductoService();
    }
    // Manejar una solicitud para obtener todos los productos
    public function getAllProductos()
    {
        try {

            $productos = $this->productoService->getAll();

            // Incluye la vista para mostrar los productos
            include __DIR__ . '/../view/productos.php';
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }

    // Manejar una solicitud para crear un nuevo producto
    public function createProducto($data)
    {
        try {
            // Llama al servicio para crear un nuevo producto
            $productoDTO = new ProductoDTO(
                $data['referencia'],
                $data['nombre'],
                $data['descripcion'],
                $data['precio'],
                $data['descuento']
            );

            $result = $this->productoService->create($productoDTO);

            if ($result) {
                // Redirige a la lista de productos tras una creación exitosa
                header('Location: index.php?action=productos');
                exit;
            } else {
                echo "<p>Error al crear el producto</p>";
            }
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }
}
?>