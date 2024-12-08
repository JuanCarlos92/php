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

            // pag Ver Comerciales
            if ($_GET['action'] === 'comerciales') {
                include __DIR__ . '/../view/comerciales.php'; 
            }
            // pag Ver comerciales en -> Crear Comercial
            if ($_GET['action'] === 'crear_comercial') {
                include __DIR__ . '/../view/form/form_comercial.php'; 
            }
            // pag Ver comerciales en  -> ventas de cada comercial
            if ($_GET['action'] === 'ventasComercial') {
                include __DIR__ . '/../view/form/form_ventas_comercial.php'; 
            }
            //pag Ver comerciales en  -> Crear Venta
            if ($_GET['action'] === 'crear_venta') {
                include __DIR__ . '/../view/form/form_venta.php'; 
            }
            //pag Ver comerciales en -> Actualizar Comercial
            if ($_GET['action'] === "actualizarComercial") {
                include __DIR__ . '/../view/form/form_actualizarComercial.php'; 
            }
            //paag Ver comerciales en -> Eliminar Comercial
            if ($_GET['action'] === "eliminarComercial") {
                include __DIR__ . '/../view/form/form_eliminarComercial.php'; 
            }

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

                $comercialDTO = new ComercialDTO(); // Crear un objeto comercialDTO y asignar valores

                $comercialDTO->setCodigo($data['codigo']);
                $comercialDTO->setNombre($data['nombre']);
                $comercialDTO->setSalario($data['salario']);
                $comercialDTO->setHijos($data['hijos']);
                $comercialDTO->setFechaNacimiento($data['fNacimiento']);

                // Llamar al servicio para crear el comercial
                $this->comercialService->create($comercialDTO);

                // Redirigir a la lista de comerciales después de crear
                header("Location: index.php?action=comerciales");

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../view/form/form_comercial.php';  // Si no es una solicitud POST mostrar el formulario comercial
        }
    }
    public function updateComercial($data)
    {
        // Verificar si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validar que el código no esté vacío y al menos un campo tenga datos
                if (empty($data['codigo']) || (empty($data['nombre']) && empty($data['salario']) && empty($data['hijos']) && empty($data['fNacimiento']))) {
                    echo "<p>Error: Debes indicar el código del comercial y al menos un campo más para actualizar.</p>";
                    return;
                }

                $comercialDTO = new ComercialDTO(); // Crear un objeto comercialDTO y asignar valores

                $comercialDTO->setCodigo($data['codigo']);
                $comercialDTO->setNombre($data['nombre']);
                $comercialDTO->setSalario($data['salario']);
                $comercialDTO->setHijos($data['hijos']);
                $comercialDTO->setFechaNacimiento($data['fNacimiento']);

                // Llamar al servicio para Actualizar el comercial
                $this->comercialService->update($comercialDTO);

                // Redirigir a la lista de comerciales después de actualizar 
                header("Location: index.php?action=comerciales");

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../view/form/form_comercial.php';  // Si no es una solicitud POST mostrar el formulario comercial
        }
    }
    public function deleteComercial($data)
    {
        // Verificar si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $data = $_POST; // Obtener los datos del formulario

                // Validar que la referencia no esté vacía
                if (empty($data['codigo'])) {
                    echo "<p>Error: Debes indicar el código del comercial para eliminar.</p>";
                    return;
                }
                $comercialDTO = new ComercialDTO(); // Crear un objeto comercialDTO y asignar valores

                $comercialDTO->setCodigo($data['codigo']);

                // Llamar al servicio para eliminar el comercial
                $this->comercialService->delete($comercialDTO);

                // Redirigir a la lista de comerciales después de actualizar 
                header("Location: index.php?action=comerciales");

            } catch (Exception $e) {
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        } else {
            include '/../view/form/form_producto.php';  // Si no es una solicitud POST mostrar el formulario producto
        }
    }
}
?>