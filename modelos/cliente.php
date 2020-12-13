<?php

require_once ('../db/conexion.php');

class Cliente 
{

    private $table_name = "Cliente";
    private $conexion;

    public $idCliente;
    public $nombre;
    public $paterno;
    public $materno;
    public $usuario;
    public $contrasena;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
    }

    public function GetClientes() 
    {
        $query = "SELECT * FROM $this->table_name";
        $stm = $this->conexion->prepare($query);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $cliente = array (
                    "idCliente" => $idCliente,
                    "nombre" => $nombre,
                    "paterno" => $paterno,
                    "materno" => $materno,
                    "usuario" => $usuario,
                    "contrasena" => $contrasena,
                );
                ksort($cliente);
                $data[] = $cliente;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetCliente() 
    {
        $query = "SELECT * FROM $this->table_name WHERE idCliente = :id";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":id", $this->idCliente);
        try{
            $stm->execute();
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $this->idCliente = $row['idCliente'];
                $this->nombre = $row['nombre'];
                $this->paterno = $row['paterno'];
                $this->materno = $row['materno'];
                $this->usuario = $row['usuario'];
                $this->contrasena = $row['contrasena'];
                return true;
            } else {
                return 'No se encontro ningun registro';;
            }
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function Login() 
    {
        $query = "SELECT * FROM $this->table_name WHERE usuario = :usuario AND :contrasena";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":usuario", $this->usuario);
        $stm->bindParam(":contrasena", $this->contrasena);

        try {
            $stm->execute();
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $this->idCliente = $row['idCliente'];
                $this->nombre = $row['nombre'];
                $this->paterno = $row['paterno'];
                $this->materno = $row['materno'];
                $this->usuario = $row['usuario'];
                $this->contrasena = $row['contrasena'];
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function NuevoCliente() {
        $query = "INSERT INTO $this->table_name SET
                nombre = :nombre,
                paterno = :paterno,
                materno = :materno,
                usuario = :usuario,
                contrasena = :contrasena";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":paterno", $this->paterno);
        $stmt->bindParam(":materno", $this->materno);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":contrasena", $this->contrasena);
    
        // execute query
        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->idCliente = $this->conexion->lastInsertId();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e){
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }

    public function ActualizarCliente() {
        $query = "UPDATE $this->table_name SET
                nombre = :nombre,
                paterno = :paterno,
                materno = :materno,
                usuario = :usuario,
                contrasena = :contrasena
                WHERE idCliente = :idCliente";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":paterno", $this->paterno);
        $stmt->bindParam(":materno", $this->materno);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":contrasena", $this->contrasena);
        $stmt->bindParam(":idCliente", $this->idCliente);
    
        // execute query
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

    public function delete()
    {
        $query = "DELETE FROM $this->table_name WHERE idCliente = :idCliente";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":idCliente", $this->idCliente);

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