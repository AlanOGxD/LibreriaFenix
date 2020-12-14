<?php

include_once('LoadRequest.php');

class CarritoController
{
    public static function getAll($usuario) {
        // Now let's make a request!
        $request = Requests::get(API_URL.'carrito/readAll?usuario='.$usuario);

        // Check what we received
        if ($request->status_code == 200){
            $data = json_decode($request->body);
            if($data) {
                return $data->carrito;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }


}


?>