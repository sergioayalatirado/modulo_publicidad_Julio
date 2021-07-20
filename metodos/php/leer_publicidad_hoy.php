<?php

include_once "../php/conexion.php";

// $mostrar = "SELECT * FROM publicidad_tv 
// WHERE CURRENT_TIMESTAMP > fecha_hora_inicio
// AND CURRENT_TIMESTAMP < fecha_hora_final;";

$mostrar = "SELECT id_publicidad,titulo_publicidad, url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,p.estatus,texto, nombre_sucursal,nombre_dispositivo, tipo_dispositivo FROM dispositivo d , publicidad p , sucursal s 
WHERE p.fk_dispositivo = d.id_dispositivo AND p.fk_sucursal= s.id_sucursal AND p.estatus=1 AND (CURRENT_TIMESTAMP > fecha_hora_inicio AND CURRENT_TIMESTAMP < fecha_hora_final) ORDER BY id_publicidad ASC ";
$resultado = mysqli_query($mysqli, $mostrar);

