<?php
require_once __DIR__ . '/../services/ComercialService.php';
require_once __DIR__ . '/../models/ComercialDTO.php';

class ComercialController
{
    private $comercialService;

    public function __construct()
    {
        $this->comercialService = new ComercialService();
    }

    // Obtener todos los comerciales
    public function getAllComerciales()
    {
        try {
            // Obtener todos los comerciales a través de comercialService
            $comerciales = $this->comercialService->getAll();

            // Incluir la vista comerciales
            include __DIR__ . '/../view/comerciales.php';
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }

    // Crear un nuevo comercial
    public function createComercial($data)
    {
        // Verificar si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {

                $data = $_POST; // Obtener los datos del formulario

                // Validar que los campos que no estén vacíos
                if (empty($data['codigo']) || empty($data['nombre']) || empty($data['salario']) || empty($data['hijos']) || empty($data['fNacimiento'])) {
                    echo "<p>Error: Todos los campos son obligatorios.</p>";
                    return;
                }

                // Crear un objeto ComercialDTO
                $comercialDTO = new ComercialDTO(
                    $data['codigo'],
                    $data['nombre'],
                    $data['salario'],
                    $data['hijos'],
                    $data['fNacimiento']
                );

                // Llamar al servicio para crear el comercial
                $this->comercialService->create($comercialDTO);

                // Redirigir a la lista de comerciales después de crear uno
                header("Location: index.php?action=comerciales"); 

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../view/form_comercial.php'; // Si no es una solicitud POST, incluir la vista con el formulario de creación
        }
    }
}
?>