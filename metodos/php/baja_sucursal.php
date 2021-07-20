<?php 
if(isset($_GET['id'])){
    include("../php/conexion.php");
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$id = validate($_GET['id']);

$mostrar = "UPDATE sucursal SET estatus=0 WHERE id_sucursal=$id";
$resultado = mysqli_query($mysqli, $mostrar);

    if($resultado > 0){
    header("Location: ../formularios/lista_sucursales.php?success=Dispositivo dado de baja exitosamente.");
    }else{
        header("Location: ../formularios/lista_sucursales.php?error=Ocurrio un error.");
    }
}else{
    header("Location: ../formularios/lista_sucursales.php");
}