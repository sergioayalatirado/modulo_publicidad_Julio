<?php include"../conexion.php";

$consulta= "SELECT formato_multimedia FROM formatos_multimedia WHERE id_formato=1";

$formatos = mysqli_query($mysqli, $consulta);
