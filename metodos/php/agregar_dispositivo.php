<?php
include_once "../php/conexion.php";
if (isset($_POST)) {
    function validate($data)
    { //VALIDA CADA UNA DE LOS VALORES RECIBIDOS POR POST DENTRO DE LA VARIABLE $DATA
        $data = trim($data); //VALIDA Y CORRIGE QUE NO HAYA ESPACIOS EN BLANCO
        $data = stripslashes($data); //QUITA la barra de escape de caracteres / **EJEMPLO: aquí \' hay una comilla simple escapada **EJEMPLO2: Aquí ' ya no hay una comilla simple escapada        $data = htmlspecialchars($data); //Traduce los caracteres especiales obtenidos dentro de $data;
        return $data;  //Retorna la variable data para poder ser tratada ya sea dentro de un echo o dentro de una variable que permitira insertarla dentro de una base de datos.
    }
}

$nombre_dispositivo = $_POST['nombre_dispositivo'];
$tipo_dispositivo = $_POST['tipo_dispositivo'];
$device_agent = $_POST['device_agent'];
$fk_sucursal = $_POST['fk_sucursal'];
$nombre_dispositivo = strtoupper($nombre_dispositivo);


$sql = "SELECT * FROM dispositivo WHERE nombre_dispositivo='$nombre_dispositivo' AND tipo_dispositivo='$tipo_dispositivo' AND fk_sucursal=$fk_sucursal";
$verificar_registro = mysqli_query($mysqli, $sql);
$resultado_rows = mysqli_num_rows($verificar_registro);

if ($resultado_rows > 0) {
    echo "Existe un registro duplicado dentro de nuestra base de datos, por favor verifica que los datos no sean iguales.";
} else {
    if (empty($nombre_dispositivo)) {
        echo "Nombre de dispositivo requerido.";
    } else if (empty($tipo_dispositivo)) {
        echo "Tipo de dispositivo requerido";
    } else if (empty($fk_sucursal)) {
        echo "Sucursal requerida.";
    } else {
        $sql = "INSERT INTO dispositivo (nombre_dispositivo,tipo_dispositivo,device_agent, fk_sucursal) VALUES('$nombre_dispositivo','$tipo_dispositivo','$device_agent','$fk_sucursal')";
        $resultado = mysqli_query($mysqli, $sql);
        if ($resultado > 0) {
            echo "Nuevo dispositivo agregado exitosamente.";
        } else {
            echo "Ocurrio un error, verifica nuevamente.";
        }
    }
}
