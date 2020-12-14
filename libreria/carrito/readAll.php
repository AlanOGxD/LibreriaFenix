<?php

include_once '../db/headers.php';
include_once '../modelos/carrito.php';

$carrito = new Carrito();

if(isset($_GET['usuario'])) {
    $carrito->usuario = $_GET['usuario'];

    $data = $carrito->GetCarritoPorUsuario();
    if(count($data) > 0) {        
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "carrito" => $data));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "carrito" => $data));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>