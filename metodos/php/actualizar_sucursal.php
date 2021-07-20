<?php
//Mostrar por ID
include_once "../php/conexion.php";
function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

if (isset($_GET['id'])) {
    
    $id = validate($_GET['id']);
    $mostrar = "SELECT * FROM sucursal WHERE id_sucursal=$id";
    $resultado = mysqli_query($mysqli, $mostrar);

    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        var_dump($row); //Muestra los valores obtenidos desde la variable $row
    } else {
        // header("Location: ../formularios/lista_sucursales.php");
        echo "No se ha obtenido algun dato con ese registro.";
    }
} 


else if (isset($_POST['id_sucursal'])) {

    $id = validate($_POST['id_sucursal']);
    $nombre_sucursal = validate($_POST['sucursal']);
    $tipo_sucursal = validate($_POST['tipo_sucursal']);

    // $datos_sucursal = 'nombre_sucursal=' . $nombre_sucursal . '&tipo_sucursal=' . $tipo_sucursal;

    if (empty($nombre_sucursal)) {
        echo "Nombre de sucursal es requerido.";
    } else if (empty($tipo_sucursal)) {
        echo "Tipo de sucursal es requerido.";
    } else {
        $sql = "UPDATE sucursal
                SET nombre_sucursal='$nombre_sucursal',
                tipo_sucursal='$tipo_sucursal',
                estatus=1 
                WHERE id_sucursal=$id";

        $resultado = mysqli_query($mysqli, $sql);

        if ($resultado > 0) {
            echo "Sucursal actualizada exitosamente.";
        } else {
            echo "Ocurrio un error al actualizar los datos.";
        }
    }
} else {
    echo "entro al else";
}
