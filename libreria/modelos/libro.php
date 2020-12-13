<?php

require_once ('../db/conexion.php');

class Libro 
{

    private $table_name = "Libro";
    private $conexion;

    public $idLibro;
    public $isbn;
    public $nombre;
    public $autor;
    public $editorial;
    public $stock;
    public $categoria;
    public $anioPublicacion;
    public $imagen;
    public $sinopsis;
    public $precio;

    public function __construct()
    {
        $this->conexion = Database::getInstance();
    }

    public function GetLibros() 
    {
        $query = "SELECT * FROM $this->table_name";
        $stm = $this->conexion->prepare($query);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $libro = array (
                    "idLibro" => $idLibro,
                    "isbn" => $isbn,
                    "nombre" => $nombre,
                    "autor" => $autor,
                    "editorial" => $editorial,
                    "stock" => $stock,
                    "categoria" => $categoria,
                    "anioPublicacion" => $anioPublicacion,
                    "imagen" => $imagen,
                    "sinopsis" => $sinopsis,
                    "precio" => $precio,
                );
                ksort($libro);
                $data[] = $libro;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetLibro() 
    {
        $query = "SELECT * FROM $this->table_name WHERE isbn = :isbn OR idLibro = :idLibro";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":isbn", $this->isbn);
        $stm->bindParam(":idLibro", $this->idLibro);
        $libro = array();
        try{
            $stm->execute();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $libro = array (
                    "idLibro" => $idLibro,
                    "isbn" => $isbn,
                    "nombre" => $nombre,
                    "autor" => $autor,
                    "editorial" => $editorial,
                    "stock" => intval($stock),
                    "categoria" => $categoria,
                    "anioPublicacion" => intval($anioPublicacion),
                    "imagen" => $imagen,
                    "sinopsis" => $sinopsis,
                    "precio" => doubleval($precio),
                );
                ksort($libro);
            }
            return $libro;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetLibrosPorCategoria() 
    {
        $query = "SELECT * FROM $this->table_name WHERE categoria = :categoria";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":categoria", $this->categoria);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $libro = array (
                    "idLibro" => $idLibro,
                    "isbn" => $isbn,
                    "nombre" => $nombre,
                    "autor" => $autor,
                    "editorial" => $editorial,
                    "stock" => intval($stock),
                    "categoria" => $categoria,
                    "anioPublicacion" => intval($anioPublicacion),
                    "imagen" => $imagen,
                    "sinopsis" => $sinopsis,
                    "precio" => doubleval($precio),
                );
                ksort($libro);
                $data[] = $libro;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function GetLibrosRamdom() 
    {
        $query = "SELECT * FROM $this->table_name ORDER BY RAND() LIMIT 5";
        $stm = $this->conexion->prepare($query);
        $stm->bindParam(":categoria", $this->categoria);
        try{
            $stm->execute();
            $data = array();
            while($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $libro = array (
                    "idLibro" => $idLibro,
                    "isbn" => $isbn,
                    "nombre" => $nombre,
                    "autor" => $autor,
                    "editorial" => $editorial,
                    "stock" => intval($stock),
                    "categoria" => $categoria,
                    "anioPublicacion" => intval($anioPublicacion),
                    "imagen" => $imagen,
                    "sinopsis" => $sinopsis,
                    "precio" => doubleval($precio),
                );
                ksort($libro);
                $data[] = $libro;
            }
            return $data;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function NuevoLibro() 
    {
        $query = "INSERT INTO $this->table_name SET
            isbn = :isbn,
            nombre = :nombre,
            autor = :autor,
            editorial = :editorial,
            stock = :stock,
            categoria = :categoria,
            anioPublicacion = :anioPublicacion,
            imagen = :imagen,
            sinopsis = :sinopsis,
            precio = :precio";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":editorial", $this->editorial);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":anioPublicacion", $this->anioPublicacion);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":sinopsis", $this->sinopsis);
        $stmt->bindParam(":precio", $this->precio);
    
        // execute query
        try{
            $this->conexion->beginTransaction();
            $stmt->execute();
            $this->idLibro = $this->conexion->lastInsertId();
            $this->conexion->commit();
            return true;
        } catch(PDOException $e){
            $this->conexion->rollback();
            return $e->getMessage();
        }
    }

    public function ActualizarLibro() 
    {
        $query = "UPDATE $this->table_name SET
            isbn = :isbn,
            nombre = :nombre,
            autor = :autor,
            editorial = :editorial,
            stock = :stock,
            categoria = :categoria,
            anioPublicacion = :anioPublicacion,
            imagen = :imagen,
            sinopsis = :sinopsis,
            precio = :precio,
            WHERE idLibro = :idLibro";

        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":autor", $this->autor);
        $stmt->bindParam(":editorial", $this->editorial);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":anioPublicacion", $this->anioPublicacion);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":sinopsis", $this->sinopsis);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":idLibro", $this->idLibro);
    
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
        $query = "DELETE FROM $this->table_name WHERE idLibro = :idLibro";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":idLibro", $this->idLibro);

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

    public function upload_image(String $source, String $destination)
    {
        $valid_ext = array('png','jpeg','jpg','webp','gif');
        $location = $_SERVER['DOCUMENT_ROOT']. '/libreria/media/'.$destination;
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

        if(in_array($file_extension, $valid_ext)) {  
            return $this->compressImage($source, $location, 80);
        } else {
            return $source . " is an invalid file type.";
        }

    }

    public function compressImage($source, $destination, $quality) {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
            return imagejpeg($image, $destination, $quality);
        }
        elseif ($info['mime'] == 'image/gif') {
            // $image = imagecreatefromgif($source);
            if(move_uploaded_file($source, $destination)) return true;
            else return "Error al copiar $destination...\n";
            // return imagegif($image, $destination);
        }
        elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
            return imagejpeg($image, $destination, $quality);
        }
        elseif ($info['mime'] == 'image/webp') {
            // $image = imagecreatefromwebp($source);
            if(move_uploaded_file($source, $destination)) return true;
            else return "Error al copiar $destination...\n";
            // return imagewebp($image, $destination, $quality);
        } else {
            if(move_uploaded_file($source, $destination)) return true;
            else return "Error al copiar $destination...\n";
        }
    }

}


?>