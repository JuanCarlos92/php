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
            return $this->comercialRepository->getAll(); // Llama al repositorio para obtener todos los comerciales

        } catch (Exception $e) {
            throw new Exception("Error al obtener los comerciales: " . $e->getMessage());
        }
    }

    // Crear un nuevo comercial
    public function create(ComercialDTO $comercialDTO)
    {
        try {
            return $this->comercialRepository->create($comercialDTO); // Llama al repositorio para crear

        } catch (Exception $e) {
            throw new Exception("Error al crear el comercial: " . $e->getMessage());
        }
    }
    public function update(ComercialDTO $comercialDTO){
        try {
            return $this->comercialRepository->update($comercialDTO); // Llama al repositorio para actualizar

        } catch (Exception $e) {
            throw new Exception("Error al actualizar el comercial: " . $e->getMessage());
        }
    }
    public function delete(ComercialDTO $comercialDTO)
    {
        try {
            return $this->comercialRepository->delete($comercialDTO); // Llama al repositorio para eliminar
            
        } catch (Exception $e) {

            throw new Exception("Error al eliminar el comercial: " . $e->getMessage());
        }
    }
}
?>