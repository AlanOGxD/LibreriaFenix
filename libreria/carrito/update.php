<?php

include_once '../db/headers.php';
include_once '../modelos/carrito.php';

$carrito = new Carrito();

$data = ( count($_POST) > 0) ? (object)$_POST : json_decode(file_get_contents("php://input"));
// $data = (object)$_POST;

if (
    isset($data->isbn) &&
    isset($data->usuario) &&
    isset($data->fecha) &&
    isset($data->cantidad) &&
    isset($data->idCarrito)
) {

    $carrito->isbn = $data->isbn;
    $carrito->usuario = $data->usuario;
    $carrito->fecha = $data->fecha;
    $carrito->cantidad = $data->cantidad;
    $carrito->idCarrito = $data->idCarrito;

    $res = $carrito->ActulizarCarrito();
    if($res === TRUE){
        http_response_code(201);
        echo json_encode(array("success" => true, "status" => 201, "message" => "Registro modificado con éxito.", "carrito" => $carrito));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else  {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos", "data" => $data));
}


?>

