<?php 
include("../php/conexion.php");

$mostrar = "SELECT * FROM dispositivo d, sucursal s
WHERE d.fk_sucursal = s.id_sucursal AND d.estatus=1 ORDER BY id_dispositivo DESC";
$resultado = mysqli_query($mysqli, $mostrar);