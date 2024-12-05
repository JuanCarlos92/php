<?php
require_once __DIR__ . '/../services/VentaService.php';
require_once __DIR__ . '/../models/VentaDTO.php';

class VentaController
{
    // Se declara una propiedad para almacenar el objeto del servicio de ventas.
    private $ventaService;

    public function __construct()
    {
        $this->ventaService = new VentaService();
    }

    // Mostrar todas las ventas
    public function getAllVentas()
    {
        try {
            $ventas = $this->ventaService->getAll(); // Se obtienen todas las ventas utilizando el servicio de ventas.
            include __DIR__ . '/../view/ventas.php'; // Se incluye la vista 'ventas.php'
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }

    // Mostrar ventas por comercial
    public function showByComercial()
    {
        // Verifica si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                $ventas = $this->ventaService->getByComercial($_POST['codComercial']);

                include __DIR__ . '/../view/ventas_comercial.php'; // Se incluye la vista 'ventas_comercial.php'
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

                // Validar que los campos que no estén vacíos
                if (empty($data['codComercial']) || empty($data['refProducto']) || empty($data['cantidad']) || empty($data['fecha'])) {
                    echo "<p>Error: Todos los campos son obligatorios.</p>";
                    return;
                }

                $ventaDTO = new VentaDTO(
                    $data['codComercial'],
                    $data['refProducto'],
                    $data['cantidad'],
                    $data['fecha'],

                );

                // Se recogen los datos del formulario (código del comercial, referencia, cantidad y fecha).
                $codComercial = $_POST['codComercial'];
                $refProducto = $_POST['refProducto'];
                $cantidad = $_POST['cantidad'];
                $fecha = $_POST['fecha'];

                // Llamar al servicio para crear el comercial
                $this->ventaService->create($ventaDTO);

                // Redirigir a la lista de comerciales después de crear uno
                header("Location: index.php?action=ventas");

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../views/form_venta.php';
        }
    }
}
?>