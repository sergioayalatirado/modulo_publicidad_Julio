<?php
if(isset($_GET['id'])){
include "../php/conexion.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    $id = validate($_GET['id']);

    $busqueda_id = "SELECT url_archivo, tipo_archivo, texto FROM publicidad WHERE id_publicidad=$id";
    $resultado = mysqli_query($mysqli, $busqueda_id);

    // $resultado = mysqli_fetch_array($resultado);
    $resultado = mysqli_fetch_assoc($resultado);
    //MOSTRAR EL VALOR DE LOS DISTINTOS ARRAY QUE SE CAPTURARON DENTRO DE LOS RESULTADO
    $archivo = $resultado['url_archivo'];
    $texto = $resultado['texto'];
    $tipo = $resultado['tipo_archivo'];

    //MOSTRAR SI LA VARIABLE $IMAGEN ESTA NULA
    echo strtoupper($tipo).'.<br>';


    //VALIDAR QUE NO TENGAN VALORES IMAGEN, VIDEO O TEXTO
    if($archivo==null || $archivo="" || $archivo == false){
                echo strtoupper("No hay ningun tipo de archivo dentro de la url archivo.<br>");
    }else{
        if($tipo=='imagen'){
                echo strtoupper("Hay una imagen.<br>");
        }else if($tipo=='video'){
                echo strtoupper("Hay un video.<br>");
        }else if($tipo=='texto'){
                echo strtoupper("Hay texto.<br>");
        }else if($tipo=='audio'){
                echo strtoupper('Hay un audio.<br>');
        }
    }

    // if($imagen=!""){
    //     echo "No hay imagen dentro";
    // }else{
    //     echo "Si hay imagen dentro";
    // }


//    print_r($resultado);

//    if($resultado = $mysqli->query($busqueda_id)){

//     while($finfo = $resultado->fetch_field()){

//         printf("id: %s\n", $finfo->idpublicidad_tv);
//     }
//     $resultado->close();
//    }
    // print_r($resultado);
    // foreach(mysqli_fetch_all($resultado, MYSQLI_ASSOC) as $fila){
    //     if(isset($fila['idpublicidad_tv'])){
    //         echo 'No hay registros';
    //     }else{
    //         echo $fila['idpublicidad_tv'];
    //     }
    // }



//     if(mysqli_num_rows($resultado)>0){
//         $array = mysqli_fetch_assoc($resultado);
        
//         foreach(mysqli_fetch_all()){
//            $id = $value ['idpublicidad_tv'];
//             $url_imagen = $value['url_imagen'];
//            $url_video = $value ['url_video'];
//             $fhi = $value['fecha_hora_inicio'];
//            $fhf = $value['fecha_hora_final'];
//            $video_imagen = $value['band_elimnar'];
//            $titulo_publicidad = $value['titulo_publicidad'];
//         }
       

//     //     $array = array("url_imagen");
//     //     if(empty($array))
//     //     {
//     //         echo 'El array SI esta vacio';
//     //     }
//     //     else{
//     //         var_dump($array);
//     // }
//     // if($resultado > 1){
//     //     echo 'Si hay una variable';;
//     // }else{
//     //     echo 'No hay nada';
//     // }
// }else{
//     echo 'f';
// }
}
