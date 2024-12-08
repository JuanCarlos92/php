<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/ProductoDTO.php';

class ProductoRepository
{
    private $db; // Almacena la conexión a la base de datos

    // inicializa la conexión a la base de datos
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Obtener todos los productos
    public function getAll()
    {
        try {
            // Consulta SQL
            $query = "SELECT * FROM productos";

            // Prepara la consulta SQL
            $stmt = $this->db->prepare($query);

            $stmt->execute(); // Ejecutar la consulta

            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array asociativo
            $productoDTOs = []; // Array para almacenar objetos ProductoDTO

            // Convertir los resultados en objetos ProductoDTO
            foreach ($productos as $producto) {
                $productoDTO = new ProductoDTO();

                // Establecer los nuevos valores utilizando los setters
                $productoDTO->setReferencia($producto['referencia']);
                $productoDTO->setNombre($producto['nombre']);
                $productoDTO->setDescripcion($producto['descripcion']);
                $productoDTO->setPrecio($producto['precio']);
                $productoDTO->setDescuento($producto['descuento']);

                $productoDTOs[] = $productoDTO; // Agregar el objeto -> al array
            }

            return $productoDTOs; // Devuelve un array de objetos

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getReferencia_Nombre()
    {
        try {
            // Consulta SQL
            $query = "SELECT referencia, nombre, descripcion FROM productos";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);

            $stmt->execute(); // Ejecutar la consulta


            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados de la consulta como un array asociativo
            $productoDTOs = []; // Array para almacenar objetos ProductoDTO

            // Convertir los resultados en objetos ProductoDTO
            foreach ($productos as $producto) {
                $productoDTO = new ProductoDTO();

                // Establecer los nuevos valores utilizando los setters
                $productoDTO->setReferencia($producto['referencia']);
                $productoDTO->setNombre($producto['nombre']);
                $productoDTO->setDescripcion($producto['descripcion']);

                $productoDTOs[] = $productoDTO; // Agregar el objeto -> al array
            }

            return $productoDTOs; // Devolver un array de objetos

        } catch (Exception $e) {
            throw $e;
        }
    }

    // Crear un nuevo producto
    public function create(ProductoDTO $productoDTO)
    {
        try {

            $referencia = strtoupper($productoDTO->getReferencia());      // Almacenar el valor devuelto por getReferencia en una variable
            $nombre = $productoDTO->getNombre();                                  // Almacenar el valor devuelto por getNombre en una variable
            $descripcion = $productoDTO->getDescripcion();                        // Almacenar el valor devuelto por getDescripcion en una variable
            $precio = $productoDTO->getPrecio();                                  // Almacenar el valor devuelto por getPrecio en una variable
            $descuento = $productoDTO->getDescuento();                            // Almacenar el valor devuelto por getDescuento en una variable

            // INSERT SQL
            $query = "INSERT INTO Productos (referencia, nombre, descripcion, precio, descuento) 
                      VALUES (:referencia, :nombre, :descripcion, :precio, :descuento)";

            // Prepara la consulta SQL
            $stmt = $this->db->prepare($query);

            // Vincular los parámetros
            $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);
            $stmt->bindParam(":descuento", $descuento, PDO::PARAM_STR);

            return $stmt->execute(); // Ejecutar la consulta

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function update(ProductoDTO $productoDTO)
    {
        try {
            $referencia = trim($productoDTO->getReferencia());      // Almacenar el valor devuelto por getReferencia() en variable
            $nombre = $productoDTO->getNombre();                            // Almacenar el valor devuelto por getNombre() en variable
            $descripcion = $productoDTO->getDescripcion();                  // Almacenar el valor devuelto por getDescripcion() en variable
            $precio = $productoDTO->getPrecio();                            // Almacenar el valor devuelto por getPrecio() en variable
            $descuento = $productoDTO->getDescuento();                      // Almacenar el valor devuelto por getDescuento() en variable

            // Validar valores vacíos y reemplazar por null
            $nombre = $nombre !== "" ? $nombre : null;
            $descripcion = $descripcion !== "" ? $descripcion : null;
            $precio = $precio !== "" ? $precio : null;
            $descuento = $descuento !== "" ? $descuento : null;

            // Construcción del UPDATE SQL
            $query = "UPDATE productos SET ";
            $campos = [];
            $param = [":referencia" => $referencia]; // Parámetro obligatorio

            if (!is_null($nombre)) {
                $campos[] = "nombre = :nombre";
                $param[":nombre"] = $nombre;
            }

            if (!is_null($descripcion)) {
                $campos[] = "descripcion = :descripcion";
                $param[":descripcion"] = $descripcion;
            }

            if (!is_null($precio)) {
                $campos[] = "precio = :precio";
                $param[":precio"] = $precio;
            }

            if (!is_null($descuento)) {
                $campos[] = "descuento = :descuento";
                $param[":descuento"] = $descuento;
            }

            // Validación: No hay campos para actualizar
            if (empty($campos)) {
                throw new Exception("No se han dado campos para actualizar.");
            }

            // Completar la consulta con los campos y la condición
            $query .= implode(", ", $campos) . " WHERE referencia = :referencia";

            // Preparar y ejecutar la consulta
            $stmt = $this->db->prepare($query);
            $stmt->execute($param);

            // Verificar si se actualizó alguna fila
            if ($stmt->rowCount() === 0) {

                throw new Exception("No se encontró ningún producto con la referencia proporcionada.");
            }

            return true;

        } catch (Exception $e) {
            throw $e;
        }
    }
    public function delete(ProductoDTO $productoDTO)
    {
        try {

            $referencia = trim(strtoupper($productoDTO->getReferencia()));      // Almacenar el valor devuelto por getReferencia en una variable

            // Verificar si el comercial tiene ventas asociadas
            $queryCheck = "SELECT COUNT(*) FROM ventas WHERE refProducto = :referencia";
            $stmt = $this->db->prepare($queryCheck);
            $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                throw new Exception("No se puede eliminar el producto {$referencia} porque tiene ventas asociadas.");
            }

            // DELETE SQL
            $query = "DELETE FROM productos WHERE referencia = :referencia";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);

            // Vincular el parámetro
            $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);

            $stmt->execute(); // Ejecutar la consulta

            // Verificar si se borró un producto

            if ($stmt->rowCount() === 0) {

                throw new Exception("No se encontró ningún producto con la referencia proporcionada.");
            }
            return true;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>