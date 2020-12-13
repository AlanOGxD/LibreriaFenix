<?php

session_start();
if(isset($_SESSION['autorizado'])) {
    $usuario = $_SESSION['usuario'];
} else {
    $usuario = 0;
    $_SESSION['usuario'] = $usuario;
}

if($usuario > 0) {
    // Establecer tiempo de vida de la sesión en segundos
    $inactividad = 600;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_unset();
            session_destroy();
            // echo "Lhjj".json_encode($_SESSION, JSON_PRETTY_PRINT);
            header("location: login.php");
        }
    }
    // El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();
}

?>