<?php
if (isset($_POST)) {
    include_once "../php/conexion.php";
    function validate($data)
    { //VALIDA CADA UNA DE LOS VALORES RECIBIDOS POR POST DENTRO DE LA VARIABLE $DATA
        $data = trim($data); //VALIDA Y CORRIGE QUE NO HAYA ESPACIOS EN BLANCO
        $data = stripslashes($data); //QUITA la barra de escape de caracteres / **EJEMPLO: aquí \' hay una comilla simple escapada **EJEMPLO2: Aquí ' ya no hay una comilla simple escapada        $data = htmlspecialchars($data); //Traduce los caracteres especiales obtenidos dentro de $data;
        return $data;  //Retorna la variable data para poder ser tratada ya sea dentro de un echo o dentro de una variable que permitira insertarla dentro de una base de datos.
    }
    $sucursal = validate($_POST['sucursal']);
    $tipo_suc = validate($_POST['tipo_sucursal']);

    //Sirve para formatear el resultado recibido del POST 
    // echo "hola2";
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    $sql = "SELECT * from sucursal WHERE nombre_sucursal='$sucursal' AND tipo_sucursal='$tipo_suc'";
    $resultado1 = mysqli_query($mysqli, $sql);
    $r1_rows = mysqli_num_rows($resultado1);

    if ($r1_rows > 0) {
        echo "Existe un registro con los mismos datos, por favor verifica e intenta nuevamente.";
    } else {
        // $datos_suc = 'sucursal='.$sucursal.'&tipo_sucursal='.$tipo_suc;

        if (empty($sucursal)) {
            echo 'Sucursal requerida.';
        } else if (empty($tipo_suc)) {
            echo 'Tipo de sucursal requerido.';
        } else {
            $sql2 = "INSERT INTO sucursal(nombre_sucursal, tipo_sucursal)
                VALUES('$sucursal','$tipo_suc')";
            $resultado2 = mysqli_query($mysqli, $sql2);
            if ($resultado2 > 0) {
                echo 'Nueva sucursal agregada exitosamente.';
            } else {
                echo 'Ocurrio un error, verifica nuevamente.';
            }
        }
    }
}
