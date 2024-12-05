<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/ComercialDTO.php';

class ComercialRepository
{
    private $db; // Almacena la conexión a la base de datos

    // inicializa la conexión a la base de datos
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Obtener todos los comerciales
    public function getAll()
    {
        try {
            //Consulta SQL
            $query = "SELECT * FROM Comerciales";

            // Prepara la consulta SQL
            $stmt = $this->db->prepare($query);
            $stmt->execute(); // Ejecutar la consulta

            // Obtener todos los resultados como un array asociativo
            $comerciales = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $comercialDTOs = []; // Array para almacenar objetos ProductoDTO

            // Convertir los resultados en objetos ComercialDTO
            foreach ($comerciales as $comercial) {
                $comercialDTOs[] = new ComercialDTO(
                    $comercial['codigo'],
                    $comercial['nombre'],
                    $comercial['salario'],
                    $comercial['hijos'],
                    $comercial['fNacimiento']
                );
            }

            return $comercialDTOs;  // Devuelve un array de objetos ComercialDTO

        } catch (Exception $e) {
            throw new Exception("Error al obtener los comerciales: " . $e->getMessage());
        }
    }

    // Crear un nuevo comercial
    public function create(ComercialDTO $comercialDTO)
    {
        try {
            //Consulta SQL
            $query = "INSERT INTO Comerciales (codigo, nombre, salario, hijos, fNacimiento) 
                  VALUES (:codigo, :nombre, :salario, :hijos, :fNacimiento)";

            // Preparar la consulta
            $stmt = $this->db->prepare($query);

            // Almacenar valores en variables antes de pasarlas por referencia
            $codigo = $comercialDTO->getCodigo();
            $nombre = $comercialDTO->getNombre();
            $salario = $comercialDTO->getSalario();
            $hijos = $comercialDTO->getHijos();
            $fNacimiento = $comercialDTO->getFechaNacimiento();

            // Vincular los parámetros con las variables
            $stmt->bindParam(":codigo", $codigo);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":salario", $salario);
            $stmt->bindParam(":hijos", $hijos);
            $stmt->bindParam(":fNacimiento", $fNacimiento);

            return $stmt->execute(); // Ejecutar la consulta

        } catch (Exception $e) {
            throw new Exception("Error al crear el comercial: " . $e->getMessage());
        }
    }
}
?>