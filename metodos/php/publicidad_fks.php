<?php 
    include "conexion.php";

$publicidad_fk = "SELECT * FROM publicidad p, dispositivo d , sucursal s
WHERE p.fk_dispositivo = d.id_dispositivo AND p.fk_sucursal = s.id_sucursal";

$resultado = mysqli_query($mysqli, $publicidad_fk);

$dispositivos = "SELECT * FROM dispositivos";
$c_dispositivos = mysqli_query($mysqli, $dispositivos);