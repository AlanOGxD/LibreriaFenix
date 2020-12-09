<?php

define("BD_HOST", "localhost");
define("BD_USU", "root");
define("BD_PASS", "alanxD");
define("BD_BASSE", "Libreria_Fenix");

function conectarse() 
{

      $conexion = new mysqli(BD_HOST, BD_USU, BD_PASS, BD_BASSE);
      if($conexion->connect_errno>0)
      {
      die("no se pudo conectar a la base de datos [".$conexion->connect_errno."]");
       }
return $conexion;
}

function getUserData($USER){
	$link = conectarse();
	$sql = "SELECT * FROM USUARIO INNER JOIN DIRECCION WHERE IDUSUARIO = USUARIO AND IDUSUARIO = $USER";
	$res = $link->query($sql);
	$data = array();
	if($res){
		while ($fila = $res->fetch_assoc()) {
			$data[] = $fila;
		}

		return $data;
	}
}
?>
