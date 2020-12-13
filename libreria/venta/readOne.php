<?php

include_once '../db/headers.php';
include_once '../modelos/venta.php';

$venta = new Venta();

if(isset($_GET['idVenta'])) {
    $venta->idVenta = $_GET['idVenta'];

    $res = $venta->GetVenta();
    if($res === TRUE) {
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "venta" => $venta));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>