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

            // pag Producto
            if ($_GET['action'] === 'productos') {
                include __DIR__ . '/../view/productos.php';
            }
            // pag Producto
            if ($_GET['action'] === 'crear_producto') {
                include __DIR__ . '/../view/form/form_producto.php';
            }
            if ($_GET['action'] === "actualizarProducto") {
                include __DIR__ . '/../view/form/form_actualizarProducto.php';
            }
            if ($_GET['action'] === "eliminarProducto") {
                include __DIR__ . '/../view/form/form_eliminarProducto.php';
            }

        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }
    public function getReferencia_Nombre()
    {
        try {
            $productos = $this->productoService->getReferencia_Nombre(); // Se obtienen la consulta de la union de la tabla venta + producto
            $comerciales = (new ComercialService())->getAll(); // Se obtienen la consulta de los comerciales

            // pag Crear nueva venta 
            if ($_GET['action'] === 'crear_venta') {

                include __DIR__ . '/../view/form/form_venta.php'; // Se incluye la vista
            }

        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }

    

    // Manejar una solicitud para crear un nuevo producto
    public function createProducto($data)
    {
        // Verifica si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validacion
                if (empty($data['referencia']) || empty($data['nombre']) || empty($data['descripcion']) || empty($data['precio']) || empty($data['descuento'])) {
                    echo "<p>Error: Todos los campos son obligatorios.</p>";
                    return;
                }

                $productoDTO = new ProductoDTO(); // Crear un objeto productoDTO y asignar valores

                $productoDTO->setReferencia($data['referencia']);
                $productoDTO->setNombre($data['nombre']);
                $productoDTO->setDescripcion($data['descripcion']);
                $productoDTO->setPrecio($data['precio']);
                $productoDTO->setDescuento($data['descuento']);

                // Llamar al servicio para crear el producto
                $this->productoService->create($productoDTO);

                // Redirige a la lista de productos despues de crear
                header('Location: index.php?action=productos');

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../views/form_producto.php'; // Si no es una solicitud POST -> mostrar el formulario producto
        }
    }
    public function updateProducto($data)
    {
        // Verificar si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validar que la referencia no esté vacía y al menos un campo tenga datos
                if (empty($data['referencia']) || (empty($data['nombre']) && empty($data['descripcion']) && empty($data['precio']) && empty($data['descuento']))) {
                    echo "<p>Error: Debes indicar la referencia del producto y al menos un campo más para actualizar.</p>";
                    return;
                }

                $productoDTO = new ProductoDTO(); // Crear un objeto productoDTO y asignar valores

                $productoDTO->setReferencia($data['referencia']);
                $productoDTO->setNombre($data['nombre']);
                $productoDTO->setDescripcion($data['descripcion']);
                $productoDTO->setPrecio($data['precio']);
                $productoDTO->setDescuento($data['descuento']);

                // Llamar al servicio para Actualizar el producto
                $this->productoService->update($productoDTO);

                // Redirigir a la lista de comerciales después de actualizar 
                header("Location: index.php?action=productos");

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../view/form/form_producto.php';  // Si no es una solicitud POST mostrar el formulario producto
        }
    }
    public function deleteProducto($data)
    {
        // Verificar si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validar que la referencia no esté vacía
                if (empty($data['referencia'])) {
                    echo "<p>Error: Debes indicar la referencia del producto para eliminar.</p>";
                    return;
                }
                $productoDTO = new ProductoDTO(); // Crear un objeto productoDTO y asignar valores

                $productoDTO->setReferencia($data['referencia']);

                // Llamar al servicio para eliminar el producto
                $this->productoService->delete($productoDTO);

                // Redirigir a la lista de productos después de actualizar 
                header("Location: index.php?action=productos");

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../view/form/form_producto.php';  // Si no es una solicitud POST mostrar el formulario producto
        }
    }
}
?>