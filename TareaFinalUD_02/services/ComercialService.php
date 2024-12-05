<?php
require_once __DIR__ . '/../repositories/ComercialRepository.php';
require_once __DIR__ . '/../models/ComercialDTO.php';

class ComercialService
{
    private $comercialRepository;

    // El constructor inicializa la conexión con el repositorio ComercialRepository
    public function __construct()
    {
        $this->comercialRepository = new ComercialRepository();
    }

    // Obtener todos los comerciales
    public function getAll()
    {
        try {
            // Llama al repositorio para obtener todos los comerciales
            return $this->comercialRepository->getAll();

        } catch (Exception $e) {
            throw new Exception("Error al obtener los comerciales: " . $e->getMessage());
        }
    }

    // Crear un nuevo comercial
    public function create(ComercialDTO $comercialDTO)
    {
        try {
            // Llama al repositorio para crear un nuevo comercial utilizando el DTO pasado como parámetro
            return $this->comercialRepository->create($comercialDTO);
        } catch (Exception $e) {
            throw new Exception("Error al crear el comercial: " . $e->getMessage());
        }
    }
}
?>