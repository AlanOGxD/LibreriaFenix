<?php

include_once '../db/headers.php';
include_once '../modelos/carrito.php';

$carrito = new Carrito();

if(isset($_GET['idCarrito'])) {
    $carrito->idCarrito = $_GET['idCarrito'];

    // delete the record
    $res = $carrito->delete();
    if($res === TRUE) {
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "message" => "Registro eliminado con éxito."));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>
