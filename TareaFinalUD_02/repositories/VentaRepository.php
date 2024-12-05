<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/VentaDTO.php';

class VentaRepository
{
    private $db; // Variable para almacenar la conexión a la base de datos

    // Constructor de la clase. Aquí se establece la conexión
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Obtener todas las ventas
    public function getAll()
    {
        try {
            // Consulta SQL
            $query = "SELECT * FROM Ventas";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);
            $stmt->execute(); // Ejecutar la consulta

            // Obtener todos los resultados de la consulta como un array
            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $ventaDTOs = [];

            // Convertir los resultados en objetos ComercialDTO
            foreach ($ventas as $venta) {
                $ventaDTOs[] = new VentaDTO(
                    $venta['codComercial'],
                    $venta['refProducto'],
                    $venta['cantidad'],
                    $venta['fecha']

                );
            }

            return $ventaDTOs; // Devolver un array de objetos VentaDTO

        } catch (Exception $e) {
            throw new Exception("Error al obtener las ventas: " . $e->getMessage());
        }
    }

    // Crear una nueva venta
    public function create(VentaDTO $ventaDTO)
    {
        try {


            // Consulta SQL
            $query = "INSERT INTO Ventas (codComercial, refProducto, cantidad, fecha) 
                  VALUES (:codComercial, :refProducto, :cantidad, :fecha)";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);

            // Almacenar valores en variables antes de pasarlas por referencia
            $codComercial = $ventaDTO->getCodComercial();
            $refProducto = $ventaDTO->getRefProducto();
            $cantidad = $ventaDTO->getCantidad();
            $fecha = $ventaDTO->getFecha();

            // Vincular los parámetros con las variables
            $stmt->bindParam(":codComercial", $codComercial);
            $stmt->bindParam(":refProducto", $refProducto);
            $stmt->bindParam(":cantidad", $cantidad);
            $stmt->bindParam(":fecha", $fecha);

            return $stmt->execute(); // Ejecutar la consulta
            
        } catch (Exception $e) {
            throw new Exception("" . $e->getMessage());
        }
    }

    // Obtener ventas por comercial
    public function getByComercial($codComercial)
    {
        try {
            // Consulta SQL
            $query = "SELECT * FROM Ventas WHERE codComercial = :codComercial";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);

            // Enlaza el parámetro :codComercial a la variable $codComercial
            $stmt->bindParam(":codComercial", $codComercial, PDO::PARAM_STR);

            //Ejecuta la consulta
            $stmt->execute();

            // Obtener todos los resultados de la consulta como un array asociativo
            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $ventaDTOs = [];

            // Convertir los resultados en objetos VentaDTO
            foreach ($ventas as $venta) {
                $ventaDTOs[] = new VentaDTO(
                    $venta['codComercial'],
                    $venta['refProducto'],
                    $venta['cantidad'],
                    $venta['fecha']
                );
            }

            return $ventaDTOs; // Devolver un array de objetos VentaDTO

        } catch (Exception $e) {
            throw new Exception("Error al obtener las ventas por comercial: " . $e->getMessage());
        }
    }
}
?>