<?php

require_once ('../db/conexion.php');
require_once ('libro.php');

class DetalleVenta
{
    private $table_name = "Detalle_Venta";
    private $conexion;
    private $libro;

    public $id;
    public $producto;
    public $cantidad;
    public $precio;
    public $total;
    public $productoId;
    public $venta;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
        $this->libro = new Libro();
    }

    public function GetDetalleVentas() 
    {
        $query = "SELECT * FROM $this->table_name";
        $stm = $this->conexion->prepare($query);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                // establecemos el id e ISBN del producto/libro
                $this->libro->idLibro = $productoId;
                $this->libro->isbn = $productoId;

                $detalle = array (
                    "id" => $id,
                    "cantidad" => $cantidad,
                    "precio" => $precio,
                    "total" => $total,
                    "productoId" => $productoId,
                    "producto" => $this->libro->GetLibro(),
                    "venta" => $venta,
                );
                ksort($detalle);
                $data[] = $detalle;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetDetalleDeVenta() 
    {
        $query = "SELECT * FROM $this->table_name WHERE venta = :venta";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":venta", $this->venta);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                // establecemos el id e ISBN del producto/libro
                $this->libro->idLibro = $productoId;
                $this->libro->isbn = $productoId;

                $detalle = array (
                    "id" => $id,
                    "cantidad" => $cantidad,
                    "precio" => $precio,
                    "total" => $total,
                    "productoId" => $productoId,
                    "producto" => $this->libro->GetLibro(),
                    "venta" => $venta,
                );
                ksort($detalle);
                $data[] = $detalle;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }


    public function NuevoDetalle() {
        $query = "INSERT INTO $this->table_name SET
                cantidad = :cantidad,
                precio = :precio,
                total = :total,
                productoId = :productoId,
                producto = :producto,
                venta = :venta";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":productoId", $this->productoId);
        $stmt->bindParam(":producto", $this->producto);
        $stmt->bindParam(":venta", $this->venta);
    
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

    public function ActualizarDetalle() {
        $query = "UPDATE $this->table_name SET
                cantidad = :cantidad,
                precio = :precio,
                total = :total,
                productoId = :productoId,
                producto = :producto,
                venta = :venta
                WHERE id = :id";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":productoId", $this->productoId);
        $stmt->bindParam(":producto", $this->producto);
        $stmt->bindParam(":venta", $this->venta);
        $stmt->bindParam(":id", $this->id);
    
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
        $query = "DELETE FROM $this->table_name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

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

    public function deleteByVenta()
    {
        $query = "DELETE FROM $this->table_name WHERE venta = :venta";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":venta", $this->id);

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