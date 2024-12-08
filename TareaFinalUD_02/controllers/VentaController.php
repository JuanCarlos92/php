<?php
require_once __DIR__ . '/../services/VentaService.php';
require_once __DIR__ . '/../models/VentaDTO.php';

class VentaController
{

    private $ventaService; // Almacena la instancia del servicio

    public function __construct()
    {
        $this->ventaService = new VentaService();
    }

    // Mostrar todas las ventas
    public function getAllVentas()
    {
        try {
            $ventas = $this->ventaService->getAll(); // Se obtienen todas las ventas utilizando el servicio de ventas

            // pag Ver todas las ventas en -> Ventas
            if ($_GET['action'] === 'ventas') {

                include __DIR__ . '/../view/ventas.php';
            }

        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }


    public function getAllVentasComerciales()
    {
        try {
            $ventas = $this->ventaService->getVentas(); // Se obtienen todas las ventas de cada comercial

            //pag Ver todas las ventas de cada comercial en  -> Actualizar Ventas
            if ($_GET['action'] === 'actualizarVenta') {

                include __DIR__ . '/../view/form/form_actualizarVenta.php';
            }
            //pag Ver todas las ventas de cada comercial en  -> Eliminar Ventas
            if ($_GET['action'] === 'eliminarVenta') {

                include __DIR__ . '/../view/form/form_eliminarVenta.php';
            }

        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }

    // Mostrar ventas por comercial
    public function getByComercial()
    {
        // Verifica si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                $ventas = $this->ventaService->getByComercial($_POST['codComercial']); // Se obtienen las ventas por comercial utilizando el servicio de ventas

                if (empty($ventas)) {
                    echo "<p>No se encontraron ventas para este comercial.</p>";
                } else {
                    // Pasar las ventas a la vista
                    include __DIR__ . '/../view/ventas_comercial.php'; // Se incluye la vista
                }

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p>Comercial no especificado.</p>";
        }
    }

    // Crear una nueva venta
    public function createVenta($data)
    {
        // Verifica si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validacion
                if (empty($data['codComercial']) || empty($data['refProducto']) || empty($data['cantidad']) || empty($data['fecha'])) {
                    echo "<p>Error: Todos los campos son obligatorios.</p>";
                    return;
                }

                $ventaDTO = new VentaDTO(); // Crear un objeto ventaDTO y asignar valores

                $ventaDTO->setCodComercial($data['codComercial']);
                $ventaDTO->setRefProducto($data['refProducto']);
                $ventaDTO->setCantidad($data['cantidad']);
                $ventaDTO->setFecha($data['fecha']);

                // Llamar al servicio para crear la venta
                $this->ventaService->create($ventaDTO);

                // Redirigir a la lista de ventas después de crear
                header("Location: index.php?action=ventas");

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../views/form_venta.php'; // Si no es una solicitud POST -> mostrar el formulario venta
        }
    }
    // Actualizar una venta
    public function updateVenta($data)
    {
        // Verifica si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validación
                if (empty($data['codComercial']) || empty($data['refProducto']) || empty($data['cantidad']) || empty($data['fecha'])) {
                    echo "<p>Error: todos los campos son obligatorios.</p>";
                    return;
                }

                $ventaDTO = new VentaDTO(); // Crear un objeto ventaDTO y asignar valores

                $ventaDTO->setCodComercial($data['codComercial']);
                $ventaDTO->setRefProducto($data['refProducto']);
                $ventaDTO->setCantidad($data['cantidad']);
                $ventaDTO->setFecha($data['fecha']);

                // Llamar al servicio para actualizar la venta
                $this->ventaService->update($ventaDTO);

                // Redirigir a la lista de ventas después de actualizar
                header("Location: index.php?action=ventas");


            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../views/form_venta.php'; // Si no es una solicitud POST -> mostrar el formulario ventas
        }
    }
    public function deleteVenta($data)
    {
        // Verifica si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validación
                if (empty($data['codComercial']) || empty($data['refProducto']) || empty($data['cantidad']) || empty($data['fecha'])) {
                    echo "<p>Error: todos los campos son obligatorios.</p>";
                    return;
                }

                $ventaDTO = new VentaDTO(); // Crear un objeto ventaDTO y asignar valores

                $ventaDTO->setCodComercial($data['codComercial']);
                $ventaDTO->setRefProducto($data['refProducto']);
                $ventaDTO->setCantidad($data['cantidad']);
                $ventaDTO->setFecha($data['fecha']);

                // Llamar al servicio para eliminar la venta
                $this->ventaService->delete($ventaDTO);

                // Redirigir a la lista de ventas después de eliminar
                header("Location: index.php?action=ventas");


            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../views/form_venta.php'; // Si no es una solicitud POST -> mostrar el formulario ventas
        }
    }
}
?>