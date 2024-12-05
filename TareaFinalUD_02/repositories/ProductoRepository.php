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
            $stmt->execute();

            // Obtener todos los resultados como un array asociativo
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $productoDTOs = []; // Array para almacenar objetos ProductoDTO

            // Convertir los resultados en objetos ProductoDTO
            foreach ($productos as $producto) {
                $productoDTOs[] = new ProductoDTO(
                    $producto['referencia'],
                    $producto['nombre'],
                    $producto['descripcion'],
                    $producto['precio'],
                    $producto['descuento']
                );
            }

            return $productoDTOs; // Devuelve un array de objetos ProductoDTO

        } catch (Exception $e) {
            throw new Exception("Error al obtener los productos: " . $e->getMessage());
        }
    }

    // Crear un nuevo producto
    public function create(ProductoDTO $productoDTO)
    {
        try {
            // Consulta SQL
            $query = "INSERT INTO Productos (referencia, nombre, descripcion, precio, descuento) 
                      VALUES (:referencia, :nombre, :descripcion, :precio, :descuento)";

            // Prepara la consulta SQL
            $stmt = $this->db->prepare($query);

            // Almacenar valores en variables antes de pasarlas por referencia
            $referencia = $productoDTO->getReferencia();
            $nombre = $productoDTO->getNombre();
            $descripcion = $productoDTO->getDescripcion();
            $precio = $productoDTO->getPrecio();
            $descuento = $productoDTO->getDescuento();

            // Vincular los parámetros
            $stmt->bindParam(":referencia", $referencia);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":descripcion", $descripcion);
            $stmt->bindParam(":precio", $precio);
            $stmt->bindParam(":descuento", $descuento);

            return $stmt->execute(); // Ejecutar la consulta

        } catch (Exception $e) {
            throw new Exception("Error al crear el producto: " . $e->getMessage());
        }
    }
}
?>