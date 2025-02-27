<?php
namespace App\Models;

use PDO;
use PDOException;

require_once MAIN_APP_ROUTE . "../models/baseModel.php";

class ProgramaModel extends BaseModel
{
    public function __construct(
        private ?int $id = null,
        private ?string $codigo = null,
        private ?string $nombre = null,
        private ?int $fk_idCentro = null,
    ) {
        // Se llama al constructor del padre
        parent::__construct();
        // Se especifica la tabla
        $this->tabla = "programaformacion";
    }

    public function savePrograma($cod, $nom, $idCen) {
        try {
            $sql = "INSERT INTO $this->tabla (codigo, nombre, FkIdCentroFormacion) VALUES (:codigo, :nombre, :fkIdCentro)";
            // 1. Se prepara la consulta
            $statement = $this->dbConnection->prepare($sql);
            // 2. bindParam para sanitizar los datso de entrada
            $statement->bindParam(":codigo", $cod, PDO::PARAM_STR);
            $statement->bindParam(":nombre", $nom, PDO::PARAM_STR);
            $statement->bindParam(":fkIdCentro", $idCen, PDO::PARAM_INT);
            // 3. Ejecutamos la consulta
            $statement->execute();
        } catch (PDOException $ex) {
            echo "Error al guardar el Programa ". $ex->getMessage();
        }
    }

    public function getPrograma($id){
        try {
            $sql = "SELECT programaFormacion.*,centroformacion.nombre as nombreCentro  
                    FROM programaFormacion 
                    INNER JOIN centroformacion 
                    ON programaFormacion.FkIdCentroFormacion = centroformacion.id
                    WHERE programaFormacion.id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return $result[0];
        } catch (PDOException $ex) {
            echo "Error al obtener el Rol" . $ex->getMessage();
        }
    }

    public function editPrograma($id, $codigo, $nombre, $fkIdCentro) {
        try {
            $sql = "UPDATE $this->tabla SET codigo=:codigo, nombre=:nombre, FkIdCentroFormacion=:fkIdCentro WHERE id=:id";
            $statement = $this->dbConnection->prepare($sql);
            $statement->bindParam(":id", $id, PDO::PARAM_INT);
            $statement->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $statement->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $statement->bindParam(":fkIdCentro", $fkIdCentro, PDO::PARAM_INT);
            $result = $statement->execute();
            return $result;
        } catch (PDOException $ex) {
            echo "No se pudo editar el rol".$ex->getMessage();
        }
    }
}