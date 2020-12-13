<?php

include_once '../db/headers.php';
include_once '../modelos/venta.php';
include_once '../modelos/detalleVenta.php';

$venta = new Venta();
$detalleVenta = new DetalleVenta();

if(isset($_GET['idVenta'])) {
    $venta->idVenta = $_GET['idVenta'];
    $detalleVenta->venta = $_GET['idVenta'];

    // delete the record
    $res = $venta->delete();
    if($res === TRUE) {
        $result = $detalleVenta->deleteByVenta();
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "message" => "Registro eliminado con éxito.", "detalleVenta" => $result));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>