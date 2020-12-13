<?php

include_once '../db/headers.php';
include_once '../modelos/libro.php';

$libro = new Libro();

$data = $libro->GetLibrosRamdom();
if(count($data) > 0){
    http_response_code(200);
    echo json_encode(array("success" => true, "status" => 200, "libros" => $data));
} else {
    http_response_code(404);
    echo json_encode(array("success" => false, "status" => 404, "message" => "No se encontraron registros"));
}

?>

