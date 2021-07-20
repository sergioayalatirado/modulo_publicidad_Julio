<?php

include "conexion.php";

$mostrar = "SELECT * FROM dispositivo d , publicidad p , sucursal s 
WHERE p.fk_dispositivo = d.id_dispositivo AND p.fk_sucursal= s.id_sucursal AND p.estatus=1 ORDER BY id_publicidad ASC";
$resultado = mysqli_query($mysqli, $mostrar);


// $url_replace = str_replace("../multimedia/", " ",)
//MOSTRAR LAS PUBLICIDADES DEL DIA EN CURSO
// SELECT * 
// FROM publicidad_tv 
// WHERE DATE_FORMAT(fecha_hora_inicio, '%Y-%m-%d')=CURRENT_DATE;