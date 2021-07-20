<?php 
include("conexion.php");

$sucursales = "SELECT * FROM sucursal WHERE estatus = 1 ORDER BY id_sucursal ASC";

$resultado = mysqli_query($mysqli, $sucursales);
