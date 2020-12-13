<?php

include_once '../db/headers.php';
include_once '../modelos/libro.php';

$libro = new Libro();

// $data = json_decode(file_get_contents("php://input"));
$data = (object)$_POST;

if (
    isset($data->isbn) &&
    isset($data->nombre) &&
    isset($data->autor) &&
    isset($data->editorial) &&
    isset($data->stock) &&
    isset($data->anioPublicacion)
    // isset($data->categoria) &&
    // isset($data->sinopsis)
    // isset($data->imagen) &&
) {
    $libro->isbn = $data->isbn;
    $libro->nombre = $data->nombre;
    $libro->autor = $data->autor;
    $libro->editorial = $data->editorial;
    $libro->stock = $data->stock;
    $libro->anioPublicacion = $data->anioPublicacion;
    $libro->categoria = '';
    if (isset($data->categoria)) {
        $libro->categoria = $data->categoria;
    }
    $libro->sinopsis = '';
    if (isset($data->sinopsis)) {
        $libro->sinopsis = $data->sinopsis;
    }
    $libro->imagen = '';
    $files = count($_FILES['imagenes']['name']);

    if ($files > 0) {
        for($i = 0; $i < $files; $i++) {
            $source = $_FILES['imagenes']['tmp_name'][$i];
            $file_extension = pathinfo($_FILES['imagenes']['name'][$i], PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);
        
            $destination = str_replace(" ", "_", $data->nombre) . "_".$i."_" . date('Y_m_d_H_i_s') . "." . $file_extension;
        
            $message = "";
            $ur = $libro->upload_image($source, $destination);
            if($ur === TRUE) {
                $libro->imagen = $destination;
            } else {
                $message = $ur;
                $ur = false; 
            }
            $upload_result[$i] = array("uploaded" => boolval($ur), "file" => $_FILES['imagenes']['name'][$i], "message" => $message);
        }
    }    

    $res = $libro->NuevoLibro();
    if($res === TRUE){
        http_response_code(201);
        echo json_encode(array("success" => true, "status" => 201, "message" => "Registro creado con éxito.", "libro" => $libro, "uploads" => $upload_result));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else  {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}


?>

