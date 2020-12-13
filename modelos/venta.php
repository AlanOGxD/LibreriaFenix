<?php

require_once ('../db/conexion.php');
require_once ('detalleVenta.php');

class Venta
{   
    private $table_name = "Venta";
    private $conexion;
    private $detalleVenta;

    public $idVenta;
    public $cliente;
    public $fecha;
    public $cantidad;
    public $totalVenta;
    public $detalle;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
        $this->detalleVenta = new DetalleVenta();
    }

    public function GetVentas() 
    {
        $query = "SELECT * FROM $this->table_name";
        $stm = $this->conexion->prepare($query);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $this->detalleVenta->venta = $idVenta;
                $venta = array (
                    "idVenta" => $idVenta,
                    "cliente" => $cliente,
                    "fecha" => $fecha,
                    "cantidad" => $cantidad,
                    "totalVenta" => $totalVenta,
                    "detalle" => $this->detalleVenta->GetDetalleDeVenta()
                );
                ksort($venta);
                $data[] = $venta;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetVenta() 
    {
        $query = "SELECT * FROM $this->table_name WHERE idVenta = :idVenta";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":idVenta", $this->idVenta);
        try{
            $stm->execute();
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                extract($row);

                $this->detalleVenta->venta = $idVenta;
                $this->idVenta = $idVenta;
                $this->cliente = $cliente;
                $this->fecha = $fecha;
                $this->cantidad = $cantidad;
                $this->totalVenta = $totalVenta;
                $this->detalle = $this->detalleVenta->GetDetalleDeVenta();
                return true;
            } else {
                return 'No se encontro ningun registro';
            }
            
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function NuevaVenta() {
        $query = "INSERT INTO $this->table_name SET
                cliente = :cliente,
                fecha = :fecha,
                cantidad = :cantidad,
                totalVenta = :totalVenta";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":cliente", $this->cliente);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":totalVenta", $this->totalVenta);
    
        // execute query
        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->idVenta = $this->conexion->lastInsertId();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e){
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }

    public function ActualizarVenta() {
        $query = "UPDATE $this->table_name SET
                cliente = :cliente
                fecha = :fecha
                cantidad = :cantidad
                totalVenta = :totalVenta
                WHERE idVenta = :idVenta";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":cliente", $this->cliente);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":cantidad", $this->cantidad);
        $stmt->bindParam(":totalVenta", $this->totalVenta);
        $stmt->bindParam(":idVenta", $this->idVenta);
    
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
        $query = "DELETE FROM $this->table_name WHERE idVenta = :idVenta";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":idVenta", $this->idVenta);

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