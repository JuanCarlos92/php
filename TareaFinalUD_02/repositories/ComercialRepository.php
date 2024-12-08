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

            $comerciales = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array asociativo
            $comercialDTOs = []; // Array para almacenar objetos ComercialDTO

            // Convertir los resultados en objetos ComercialDTO
            foreach ($comerciales as $comercial) {
                $comercialDTO = new ComercialDTO();

                // Establecer los nuevos valores utilizando los setters
                $comercialDTO->setCodigo($comercial['codigo']);
                $comercialDTO->setNombre($comercial['nombre']);
                $comercialDTO->setSalario($comercial['salario']);
                $comercialDTO->setHijos($comercial['hijos']);
                $comercialDTO->setFechaNacimiento($comercial['fNacimiento']);

                $comercialDTOs[] = $comercialDTO; // Agregar el objeto -> al array
            }

            return $comercialDTOs; // Devolver un array de objetos

        } catch (Exception $e) {
            throw $e;
        }
    }

    // Crear un nuevo comercial
    public function create(ComercialDTO $comercialDTO)
    {
        try {

            $codigo = trim($comercialDTO->getCodigo());     // Almacenar el valor devuelto por getCodigo() en variable
            $nombre = $comercialDTO->getNombre();                   // Almacenar el valor devuelto por getNombre() en variable
            $salario = $comercialDTO->getSalario();                 // Almacenar el valor devuelto por getSalario() en variable
            $hijos = $comercialDTO->getHijos();                     // Almacenar el valor devuelto por getHijos() en variable
            $fNacimiento = $comercialDTO->getFechaNacimiento();     // Almacenar el valor devuelto por getFechaNacimiento() en variable

            // Verificar si el salario es negativa
            //if ($salario < 0) {
            //    throw new Exception("La el salario no puede ser negativo.");
            //}
            // Verificar si los hijos son negativos
            //if ($hijos < 0) {
            //     throw new Exception("El número minimo de hijos no puede ser negativo.");
            //}

            //Consulta SQL
            $query = "INSERT INTO Comerciales (codigo, nombre, salario, hijos, fNacimiento) 
                  VALUES (:codigo, :nombre, :salario, :hijos, :fNacimiento)";

            // Preparar la consulta
            $stmt = $this->db->prepare($query);

            // Vincular los parámetros con las variables
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":salario", $salario, PDO::PARAM_STR);
            $stmt->bindParam(":hijos", $hijos, PDO::PARAM_INT);
            $stmt->bindParam(":fNacimiento", $fNacimiento, PDO::PARAM_STR);

            return $stmt->execute(); // Ejecutar la consulta

        } catch (Exception $e) {
            throw $e;
        }
    }
    public function update(ComercialDTO $comercialDTO)
    {
        try {
            $codigo = trim($comercialDTO->getCodigo());     // Almacenar el valor devuelto por getCodigo() en variable
            $nombre = $comercialDTO->getNombre();                   // Almacenar el valor devuelto por getNombre() en variable
            $salario = $comercialDTO->getSalario();                 // Almacenar el valor devuelto por getSalario() en variable
            $hijos = $comercialDTO->getHijos();                     // Almacenar el valor devuelto por getHijos() en variable
            $fNacimiento = $comercialDTO->getFechaNacimiento();     // Almacenar el valor devuelto por getFechaNacimiento() en variable

            // Validar valores vacíos y reemplazar por null
            $nombre = $nombre !== "" ? $nombre : null;
            $salario = $salario !== "" ? $salario : null;
            $hijos = $hijos !== "" ? $hijos : null;
            $fNacimiento = $fNacimiento !== "" ? $fNacimiento : null;

            // Construcción de la consulta SQL
            $query = "UPDATE Comerciales SET ";
            $campos = [];
            $param = [":codigo" => $codigo]; // Parámetros iniciales (código)

            if (!is_null($nombre)) {
                $campos[] = "nombre = :nombre";
                $param[":nombre"] = $nombre;
            }

            if (!is_null($salario)) {
                $campos[] = "salario = :salario";
                $param[":salario"] = $salario;
            }

            if (!is_null($hijos)) {
                $campos[] = "hijos = :hijos";
                $param[":hijos"] = $hijos;
            }

            if (!is_null($fNacimiento)) {
                $campos[] = "fNacimiento = :fNacimiento";
                $param[":fNacimiento"] = $fNacimiento;
            }

            // Validación: No hay campos para actualizar
            if (empty($campos)) {
                throw new Exception("No se han dado campos para actualizar.");
            }

            // Completar la consulta con los campos y la condición
            $query .= implode(", ", $campos) . " WHERE codigo = :codigo";

            // Preparar y ejecutar la consulta
            $stmt = $this->db->prepare($query);
            $stmt->execute($param);

            // Verificar si se actualizó alguna fila
            if ($stmt->rowCount() === 0) {

                throw new Exception("No se encontró ningún comercial con el código proporcionado.");
            }

            return true;

        } catch (Exception $e) {
            throw $e;
        }
    }
    public function delete(ComercialDTO $comercialDTO)
    {
        try {

            $codigo = trim($comercialDTO->getCodigo());      // Almacenar el valor devuelto por getCodigo en una variable

            // Verificar si el comercial tiene ventas asociadas
            $queryCheck = "SELECT COUNT(*) FROM ventas WHERE codComercial = :codigo";
            $stmt = $this->db->prepare($queryCheck);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                throw new Exception("No se puede eliminar el comercial con código {$codigo} porque tiene ventas asociadas.");
            }

            // DELETE SQL
            $query = "DELETE FROM comerciales WHERE codigo = :codigo";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);

            // Vincular el parámetro
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);

            $stmt->execute(); // Ejecutar la consulta

            // Verificar si se borró un producto
            if ($stmt->rowCount() === 0) {

                throw new Exception("No se encontró ningún comercial con el codigo proporcionada.");
            }
            return true;


        } catch (Exception $e) {
            throw $e;
        }
    }

}
?>