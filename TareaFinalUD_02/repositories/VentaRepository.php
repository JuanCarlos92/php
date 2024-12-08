<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/VentaDTO.php';

class VentaRepository
{
    private $db; // Almacena la conexión a la bd

    // Constructor de la clase -> Se establece la conexión
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

            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array
            $ventaDTOs = []; // Array para almacenar objetos VentaDTO

            // Convertir los resultados en objetos ComercialDTO
            foreach ($ventas as $venta) {
                $ventaDTO = new VentaDTO();

                // Establecer los nuevos valores utilizando los setters
                $ventaDTO->setCodComercial($venta['codComercial']);
                $ventaDTO->setRefProducto($venta['refProducto']);
                $ventaDTO->setCantidad($venta['cantidad']);
                $ventaDTO->setFecha($venta['fecha']);

                $ventaDTOs[] = $ventaDTO; // Agregar el objeto -> al array
            }

            return $ventaDTOs; // Devolver un array de objetos

        } catch (Exception $e) {
            throw $e;
        }
    }

    // Obtener ventas por comercial
    public function getByComercial($codComercial)
    {
        try {
            // Consulta SQL Comerciales JOIN ventas JOIN productos 
            $query = "SELECT c.codigo AS Codigo_Comercial, c.nombre AS Nombre_Comercial, v.fecha AS Fecha_Venta, 
                            v.refProducto AS Referencia_Producto, p.nombre AS Nombre_Producto, v.cantidad AS Cantidad_Vendida
                      FROM comerciales c 
                      JOIN ventas v ON c.codigo = v.codComercial
                      JOIN productos p ON v.refProducto = p.referencia
                      WHERE c.codigo = :codComercial";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":codComercial", $codComercial, PDO::PARAM_INT); // Enlazar el parámetro :codComercial a la variable $codComercial

            // Ejecutar la consulta
            $stmt->execute();

            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array
            $ventaDTOs = []; // Array para almacenar objetos VentaDTO

            // Convertir los resultados en objetos VentaDTO
            foreach ($ventas as $venta) {
                $ventaDTO = new VentaDTO();

                // Establecer los nuevos valores utilizando los setters
                $ventaDTO->setCodComercial($venta['Codigo_Comercial']);
                $ventaDTO->setRefProducto($venta['Referencia_Producto']);
                $ventaDTO->setCantidad($venta['Cantidad_Vendida']);
                $ventaDTO->setFecha($venta['Fecha_Venta']);
                $ventaDTO->setNombreComercial($venta['Nombre_Comercial']);
                $ventaDTO->setNombreProducto($venta['Nombre_Producto']);


                $ventaDTOs[] = $ventaDTO; // Agregar el objeto -> al array
            }

            return $ventaDTOs; // Devolver un array de objetos

        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getVentas()
    {
        try {

            // Consulta SQL
            $query = " SELECT v.codComercial AS CodigoComercial, c.nombre AS NombreComercial, v.refProducto AS ReferenciaProducto,
                    p.nombre AS NombreProducto, p.descripcion AS DescripcionProducto, v.cantidad AS CantidadVenta, v.fecha AS FechaVenta
                    FROM 
                    ventas v
                    JOIN comerciales c ON v.codComercial = c.codigo
                    JOIN productos p ON v.refProducto = p.referencia";

            // Preparar la consulta SQL
            $stmt = $this->db->prepare($query);

            $stmt->execute();

            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array
            $ventaDTOs = []; // Array para almacenar objetos VentaDTO

            // Convertir los resultados en objetos VentaDTO
            foreach ($ventas as $venta) {
                $ventaDTO = new VentaDTO();

                // Establecer los nuevos valores utilizando los setters
                $ventaDTO->setCodComercial($venta['CodigoComercial']);
                $ventaDTO->setNombreComercial($venta['NombreComercial']);
                $ventaDTO->setRefProducto($venta['ReferenciaProducto']);
                $ventaDTO->setNombreProducto($venta['NombreProducto']);
                $ventaDTO->setDescripcionProducto($venta['DescripcionProducto']);
                $ventaDTO->setCantidad($venta['CantidadVenta']);
                $ventaDTO->setFecha($venta['FechaVenta']);


                $ventaDTOs[] = $ventaDTO; // Agregar el objeto -> al array
            }

            return $ventaDTOs; // Devolver un array de objetos

        } catch (Exception $e) {
            throw $e;
        }
    }

    // Crear una nueva venta
    public function create(VentaDTO $ventaDTO)
    {
        try {

            $codComercial = trim($ventaDTO->getCodComercial());        // Almacenar el valor devuelto por getCodComercial en una variable
            $refProducto = strtoupper($ventaDTO->getRefProducto());    // Almacenar el valor devuelto por getRefProducto en una variable
            $cantidad = $ventaDTO->getCantidad();                              // Almacenar el valor devuelto por getCantidad en una variable
            $fecha = $ventaDTO->getFecha();                                    // Almacenar el valor devuelto por getFecha en una variable


            //  ------>  VERIFICAR [COMERCIAL] EXISTE  <------
            $queryComercial = "SELECT COUNT(*) FROM comerciales WHERE codigo = :codComercial";

            $stmt = $this->db->prepare($queryComercial); // Preparar la consulta SQL
            $stmt->bindParam(':codComercial', $codComercial, PDO::PARAM_STR); // Vinculamos el valor de :codComercial con el parámetro de la consulta

            $stmt->execute();

            if ($stmt->fetchColumn() == 0) {
                throw new Exception("El comercial con código " . $codComercial . " no existe.");
            }

            //  ------>  VERIFICAR [PRODUCTO] EXISTE  <------
            $queryProducto = "SELECT COUNT(*) FROM productos WHERE referencia = :refProducto";

            $stmt = $this->db->prepare($queryProducto); // Preparar la consulta SQL
            $stmt->bindParam(':refProducto', $refProducto, PDO::PARAM_STR); // Vinculamos el valor de :codComercial con el parámetro de la consulta

            $stmt->execute();

            if ($stmt->fetchColumn() == 0) {
                throw new Exception("El producto con referencia " . $ventaDTO->getRefProducto() . " no existe.");
            }

            //  ------>  INSERT INTO  <------
            $queryInsertar = "INSERT INTO Ventas (codComercial, refProducto, cantidad, fecha) 
                        VALUES (:codComercial, :refProducto, :cantidad, :fecha)";

            $stmt = $this->db->prepare($queryInsertar); // Preparar la consulta SQL

            // Vincular parámetros
            $stmt->bindParam(':codComercial', $codComercial, PDO::PARAM_STR);
            $stmt->bindParam(':refProducto', $refProducto, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

            return $stmt->execute(); // Ejecutar la consulta

        } catch (Exception $e) {
            throw $e;
        }
    }

    // Actualizar una venta
    public function update(VentaDTO $ventaDTO)
    {
        try {

            $codComercial = trim($ventaDTO->getCodComercial());             // Almacenar el valor devuelto por getCodComercial en una variable
            $refProducto = strtoupper($ventaDTO->getRefProducto());         // Almacenar el valor devuelto por getRefProducto en una variable
            $cantidad = $ventaDTO->getCantidad();                                   // Almacenar el valor devuelto por getCantidad en una variable
            $fecha = $ventaDTO->getFecha();                                         // Almacenar el valor devuelto por getFecha en una variable

            //  ------>  VERIFICAR [COMERCIAL] EXISTE  <------
            $queryComercial = "SELECT COUNT(*) FROM comerciales WHERE codigo = :codComercial";

            $stmt = $this->db->prepare($queryComercial); // Preparar la consulta SQL
            $stmt->bindParam(':codComercial', $codComercial, PDO::PARAM_INT); // Vinculamos el valor de :codComercial con el parámetro de la consulta

            $stmt->execute();

            if ($stmt->fetchColumn() == 0) {
                throw new Exception("El comercial con código " . $codComercial . " no existe.");
            }

            //  ------>  VERIFICAR [PRODUCTO] EXISTE  <------
            $queryProducto = "SELECT COUNT(*) FROM productos WHERE referencia = :refProducto";

            $stmt = $this->db->prepare($queryProducto);// Preparar la consulta SQL
            $stmt->bindParam(':refProducto', $refProducto, PDO::PARAM_STR); // Vinculamos el valor de :refProducto con el parámetro de la consulta

            $stmt->execute();

            if ($stmt->fetchColumn() == 0) {
                throw new Exception("El producto con referencia " . $refProducto . " no existe.");
            }

            //  ------>  VERIFICAR VENTA ACTUAL <------
            $queryVenta = "SELECT cantidad, fecha FROM ventas WHERE codComercial = :codComercial AND refProducto = :refProducto";

            $stmt = $this->db->prepare($queryVenta); // Preparar la consulta SQL
            $stmt->bindParam(':codComercial', $codComercial, PDO::PARAM_INT);  // Vinculamos el valor de :codComercial con el parámetro de la consulta
            $stmt->bindParam(':refProducto', $refProducto, PDO::PARAM_STR); // Vinculamos el valor de :refProducto con el parámetro de la consulta

            $stmt->execute();

            $ventaActual = $stmt->fetch(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array

            if (!$ventaActual) {
                throw new Exception("No se encontró ninguna venta con el código del comercial y la referencia.");
            }

            //  ------>  UPDATE  <------
            $queryUpdate = "UPDATE Ventas SET ";

            $campos = [];
            $param = [":codComercial" => $codComercial, ":refProducto" => $refProducto]; // Parámetros obligatorios

            if ($ventaActual['cantidad'] != $cantidad) {
                $campos[] = "cantidad = :cantidad";
                $param[':cantidad'] = $cantidad;
            }

            if ($ventaActual['fecha'] != $fecha) {
                $campos[] = "fecha = :fecha";
                $param[':fecha'] = $fecha;
            }

            // Validación: No hay campos para actualizar
            if (empty($campos)) {
                throw new Exception("Estos valores ya están registrados. No hay campos para actualizar.");
            }

            // ------>  WHERE  <------
            $where = "WHERE codComercial = :codComercial AND refProducto = :refProducto";

            if (!empty($ventaActual['fecha'])) {
                $where .= " AND fecha = :fechaAntigua"; // Usar la fecha anterior como filtro
                $param[':fechaAntigua'] = $ventaActual['fecha'];
            }

            if (!empty($ventaActual['cantidad'])) {
                $where .= " AND cantidad = :cantidadAntigua"; // Usar la cantidad anterior como filtro
                $param[':cantidadAntigua'] = $ventaActual['cantidad'];
            }

            // Completar la consulta con los campos y la condición
            $queryUpdate .= implode(", ", $campos) . " $where";

            // Preparar y ejecutar la consulta
            $stmt = $this->db->prepare($queryUpdate);
            $stmt->execute($param);

            // Verificar si se actualizó alguna fila
            if ($stmt->rowCount() === 0) {

                throw new Exception("No se encontró ninguna venta con el codigo del comercial y la referencia proporcionada.");
            }

            return true;

        } catch (Exception $e) {
            throw $e;
        }
    }
    public function delete(VentaDTO $ventaDTO)
    {
        try {
            $codComercial = trim($ventaDTO->getCodComercial());             // Almacenar el valor devuelto por getCodComercial en una variable
            $refProducto = strtoupper($ventaDTO->getRefProducto());         // Almacenar el valor devuelto por getRefProducto en una variable
            $cantidad = $ventaDTO->getCantidad();                                   // Almacenar el valor devuelto por getCantidad en una variable
            $fecha = $ventaDTO->getFecha();                                         // Almacenar el valor devuelto por getFecha en una variable

            //  ------>  DELETE  <------
            $queryDelete = "DELETE FROM ventas WHERE codComercial = :codComercial 
                        AND refProducto = :refProducto;
                        AND cantidad = :cantidad 
                        AND fecha = :fecha";

            $stmt = $this->db->prepare($queryDelete); // Preparar la consulta SQL

            // Vincular parámetros
            $stmt->bindParam(':codComercial', $codComercial, PDO::PARAM_INT);
            $stmt->bindParam(':refProducto', $refProducto, PDO::PARAM_STR);
            $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

            $stmt->execute(); // Ejecutar la consulta


            // Verificar si se actualizó alguna fila
            if ($stmt->rowCount() === 0) {

                throw new Exception("No se encontró ninguna venta con el codigo del comercial y la referencia proporcionada.");
            }

            return true;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>