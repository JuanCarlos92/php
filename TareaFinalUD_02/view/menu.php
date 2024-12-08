<?php
// Incluir los controladores
require_once __DIR__ . '/../controllers/ComercialController.php';
require_once __DIR__ . '/../controllers/ProductoController.php';
require_once __DIR__ . '/../controllers/VentaController.php';

// Obtener la acción desde la URL (por defecto, mostrar el menú principal)
$action = $_GET['action'] ?? 'menu';

// Cargar el contenido basado en la acción
switch ($action) {
    case 'comerciales':
        (new ComercialController())->getAllComerciales();
        break;

    case 'crear_comercial':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new ComercialController())->createComercial($_POST);
        } else {
            (new ComercialController())->getAllComerciales(); // Cargar el formulario y CREAR COMERCIALES
        }
        break;

    case 'actualizarComercial':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new ComercialController())->updateComercial($_POST);
        } else {
            (new ComercialController())->getAllComerciales(); // Cargar el formulario y ACTUALIZAR COMERCIALES
        }
        break;
    case 'eliminarComercial':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new ComercialController())->deleteComercial($_POST);
        } else {
            (new ComercialController())->getAllComerciales(); // Cargar el formulario y ELIMINAR COMERCIAL
        }

    case 'productos':
        (new ProductoController())->getAllProductos();
        break;

    case 'crear_producto':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new ProductoController())->createProducto($_POST);
        } else {
            (new ProductoController())->getAllProductos(); // Cargar el formulario y CREAR PRODUCTOS
        }
        break;

    case 'actualizarProducto':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new ProductoController())->updateProducto($_POST);
        } else {
            (new ProductoController())->getAllProductos(); // Cargar el formulario y ACTUALIZAR PRODUCTO
        }
        break;

    case 'eliminarProducto':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new ProductoController())->deleteProducto($_POST);
        } else {
            (new ProductoController())->getAllProductos(); // Cargar el formulario y ELIMINAR PRODUCTO
        }

        break;
    case 'ventas':
        (new VentaController())->getAllVentas();
        break;

    case 'crear_venta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new VentaController())->createVenta($_POST);
        } else {
            (new ProductoController())->getReferencia_Nombre(); // Cargar el formulario y CREAR VENTA
        }
        break;

    case 'actualizarVenta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new VentaController())->updateVenta($_POST);
        } else {
            (new VentaController())->getAllVentasComerciales(); // Cargar el formulario y ACTUALIZAR VENTA
        }
        break;

    case 'eliminarVenta':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new VentaController())->deleteVenta($_POST);
        } else {
            (new VentaController())->getAllVentasComerciales(); // Cargar el formulario y ELIMINAR VENTA
        }
        break;

    case 'ventasComercial':
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            (new VentaController())->getByComercial();
        } else {
            (new ComercialController())->getAllComerciales(); // Cargar el formulario y los comerciales
        }
        break;

}
?>