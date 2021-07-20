<?php

include_once "conexion.php";
if (isset($_GET['id'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // echo "Llego al php de baja_publicidad.php de la ruta metodos/php/";

    $id = validate($_GET['id']);

    $actualizar = "UPDATE publicidad SET estatus=0 WHERE id_publicidad='$id'";
    $resultado = mysqli_query($mysqli, $actualizar);

    // echo $resultado;
    if ($resultado > 0) {
        echo "Se ha eliminado exitosamente la publicidad.";
        header("Location: ../formularios/leer_publicidad.php?success=Se ha eliminado exitosamente la publicidad.");    
    } else {
        echo "Ocurrio un error.";
    }
}else{
    header("Location: ../formularios/leer_publicidad.php");    
}
