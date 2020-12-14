<?php

require_once ('../db/conexion.php');
require_once ('libro.php');

class Carrito
{
    private $table_name = "carrito";
    private $conexion;
    private $libro;

    public $idCarrito;
    public $isbn;
    public $usuario;
    public $fecha;
    public $cantidad;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
        $this->libro = new Libro();
    }

    public function GetCarritoPorUsuario() 
    {
        $query = "SELECT * FROM $this->table_name WHERE usuario = :usuario";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":usuario", $this->usuario);

        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $this->libro->isbn = $isbn;
                $venta = array (
                    "idCarrito" => $idCarrito,
                    "isbn" => $isbn,
                    "usuario" => $usuario,
                    "fecha" => $fecha,
                    "cantidad" => $cantidad,
                    "libro" => $this->libro->GetLibro()
                );
                ksort($venta);
                $data[] = $venta;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetCarrito() 
    {
        $query = "SELECT * FROM $this->table_name WHERE idCarrito = :idCarrito";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":idCarrito", $this->idCarrito);

        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $this->libro->isbn = $isbn;
                $venta = array (
                    "idCarrito" => $idCarrito,
                    "isbn" => $isbn,
                    "usuario" => $usuario,
                    "fecha" => $fecha,
                    "cantidad" => $cantidad,
                    "libro" => $this->libro->GetLibro()
                );
                ksort($venta);
                $data[] = $venta;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function AgregarACarrito() {
        $query = "INSERT INTO $this->table_name SET
                isbn = :isbn,
                usuario = :usuario,
                fecha = :fecha,
                cantidad = :cantidad";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":cantidad", $this->cantidad);
    
        // execute query
        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->idCarrito = $this->conexion->lastInsertId();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e){
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }

    public function ActulizarCarrito() {
        $query = "UPDATE $this->table_name SET
                isbn = :isbn,
                usuario = :usuario,
                fecha = :fecha,
                cantidad = :cantidad
                WHERE idCarrito = :idCarrito";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":idCarrito", $this->idCarrito);
    
        // execute query
        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->idCarrito = $this->conexion->lastInsertId();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e){
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }

    public function delete()
    {
        $query = "DELETE FROM $this->table_name WHERE idCarrito = :idCarrito";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":idCarrito", $this->idCarrito);

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

    public function deleteByUsuario()
    {
        $query = "DELETE FROM $this->table_name WHERE usuario = :usuario";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":usuario", $this->usuario);

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