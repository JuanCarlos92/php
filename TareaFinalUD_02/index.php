<?php
// Incluir los controladores
require_once __DIR__ . '/controllers/ComercialController.php';
require_once __DIR__ . '/controllers/ProductoController.php';
require_once __DIR__ . '/controllers/VentaController.php';



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de Ventas</title>
    <link rel="stylesheet" href="view/css/stylesMenu.css">
</head>

<body>

    <nav>
        <ul>
            <li><a href="index.php?action=comerciales">Comerciales</a></li>
            <li><a href="index.php?action=productos">Productos</a></li>
            <li><a href="index.php?action=ventas">Ventas</a></li>
        </ul>
    </nav>

    <div id="content">
        <?php
        // Obtener la acción desde la URL (por defecto, ir al menú principal)
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
                    include __DIR__ . '/view/form_comercial.php'; // Formulario para crear comercial
                }
                break;

            case 'productos':
                (new ProductoController())->getAllProductos();
                break;

            case 'crear_producto':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new ProductoController())->createProducto($_POST);
                } else {
                    include __DIR__ . '/view/form_producto.php'; // Formulario para crear producto
                }
                break;

            case 'ventas':
                (new VentaController())->getAllVentas();
                break;

            case 'crear_venta':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    (new VentaController())->createVenta($_POST);
                } else {
                    include __DIR__ . '/view/form_venta.php'; // Formulario para crear venta
                }
                break;

            default:
                include __DIR__ . '/view/menu.php'; // Página de inicio o menú principal
                break;
        }
        ?>
    </div>

</body>

</html>