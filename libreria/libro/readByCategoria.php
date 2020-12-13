<?php

include_once '../db/headers.php';
include_once '../modelos/libro.php';

$libro = new Libro();

if(isset($_GET['categoria'])) {
    $libro->categoria = $_GET['categoria'];

    $data = $libro->GetLibrosPorCategoria();
    if(count($data) > 0) {
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "libros" => $data));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>