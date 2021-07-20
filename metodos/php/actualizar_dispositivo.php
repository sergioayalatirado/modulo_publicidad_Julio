<?php 
include_once "../php/conexion.php";
//Mostrar por ID

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_GET['id'])){   
    $id = validate($_GET['id']);
    $mostrar = "SELECT * FROM dispositivo WHERE id_dispositivo=$id";
    $resultado = mysqli_query($mysqli, $mostrar);

    if(mysqli_num_rows($resultado)>0){
        $row = mysqli_fetch_assoc($resultado);
        var_dump($row);
    }else{
        header("Location: lista_dispositivos.php");
    }
}

else if(isset($_POST['id_dispositivo'])){
   
    $id = validate($_POST['id_dispositivo']);
    $nombre_dispositivo = validate($_POST['nombre_dispositivo']);
    $tipo_dispositivo = validate($_POST['tipo_dispositivo']);
    $device_agent = validate($_POST['device_agent']);
    $fk_sucursal = validate($_POST['fk_sucursal']);


    $sql = "SELECT * FROM dispositivo WHERE id_dispositivo='$id' AND nombre_dispositivo='$nombre_dispositivo' AND tipo_dispositivo='$tipo_dispositivo' AND device_agent='$device_agent' AND fk_sucursal='$fk_sucursal'";

    $consulta = mysqli_query($mysqli, $sql);
    $consulta_rows = mysqli_num_rows($consulta);

    if($consulta_rows > 0){
        echo "No se han aplicado cambios a este dispositivo ya que no se detectaron cambios.";
    }else{
        if(empty($nombre_dispositivo)){
            echo "Nombre de dispositivo es requerido.";
        }else if(empty($tipo_dispositivo)){
            echo "Tipo de dispositivo es requerido.";
        }else if(empty($fk_sucursal)){
            echo "Sucursal es requerida.";
        }else{
            $sql = "UPDATE dispositivo
                    SET nombre_dispositivo='$nombre_dispositivo',
                    tipo_dispositivo='$tipo_dispositivo',
                    device_agent='$device_agent',
                    fk_sucursal='$fk_sucursal' 
                    WHERE id_dispositivo=$id";
                    
            $resultado = mysqli_query($mysqli , $sql);
    
            if($resultado > 0){
                echo "Dispositivo actualizado exitosamente.";
            }else{
                echo "Ocurrio un error al actualizar los datos.";
            }
        }
    }
    // $datos_dispositivo= 'nombre_dispositivo='.$nombre_dispositivo.'&tipo_dispositivo='.$tipo_dispositivo.'&device_agent='.$device_agent.'&sucursal='.$fk_sucursal;


}else{
    // header("Location: ../formularios/lista_dispositivos.php");
    echo "Entro al else";
}

