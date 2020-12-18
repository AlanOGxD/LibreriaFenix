<?php

require_once ('../db/conexion.php');

class Usuario 
{

    private $table_name = "usuario";
    private $conexion;

    public $idUsuario;
    public $nombre;
    public $tipo;
    public $usuario;
    public $contrasena;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
    }

    public function GetUsuarios() 
    {
        $query = "SELECT * FROM $this->table_name";
        $stm = $this->conexion->prepare($query);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $usuario = array (
                    "idUsuario" => $idUsuario,
                    "nombre" => $nombre,
                    "tipo" => $tipo,
                    "usuario" => $usuario,
                    "contrasena" => $contrasena,
                );
                ksort($usuario);
                $data[] = $usuario;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetUsuario() 
    {
        $query = "SELECT * FROM $this->table_name WHERE IDUSUARIO = :id";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":id", $this->idUsuario);
        try{
            $stm->execute();
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            $this->idUsuario = $row['idUsuario'];
            $this->nombre = $row['nombre'];
            $this->tipo = $row['tipo'];
            $this->usuario = $row['usuario'];
            $this->contrasena = $row['contrasena'];
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function Login() 
    {
        $query = "SELECT * FROM $this->table_name WHERE usuario = :usuario AND contrasena = :contrasena";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":usuario", $this->usuario);
        $stm->bindParam(":contrasena", $this->contrasena);
        try {
            $stm->execute();
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $this->idUsuario = $row['idUsuario'];
                $this->nombre = $row['nombre'];
                $this->tipo = $row['tipo'];
                $this->usuario = $row['usuario'];
                $this->contrasena = $row['contrasena'];
                return true;
            } else {
                return 'No se encontro ningun registro';
            }            
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function NuevoUsuario() {
        $query = "INSERT INTO $this->table_name SET
                nombre = :nombre,
                tipo = :tipo,
                usuario = :usuario,
                contrasena = :contrasena";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":contrasena", $this->contrasena);
    
        // execute query
        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->idUsuario = $this->conexion->lastInsertId();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e){
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }

    public function ActualizarUsuario() {
        $query = "UPDATE $this->table_name SET
                nombre = :nombre,
                tipo = :tipo,
                usuario = :usuario,
                contrasena = :contrasena
                WHERE idUsuario = :idUsuario";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":idUsuario", $this->idUsuario);
    
        // execute query
        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e) {
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }

    public function delete()
    {
        $query = "DELETE FROM $this->table_name WHERE idUsuario = :idUsuario";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":idUsuario", $this->idUsuario);

        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e){
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }
}


?>