<?php
include_once '../php/conexion.php';
sleep(3);
$titulo = $_POST['titulo_publicidad'];
$texto = $_POST['texto'];
$fecha_inicio = $_POST['fecha_inicio'];
$hora_inicio = $_POST['hora_inicio'];
$fecha_final = $_POST['fecha_final'];
$hora_final = $_POST['hora_final'];
$fk_sucursal = $_POST['fk_sucursal'];
$fk_dispositivo = $_POST['fk_dispositivo'];
$archivo = $_FILES['archivo'];
$tipo = $_FILES['archivo']['type'];
$archivo_tamano = $_FILES['archivo']['size'];

// Archivo 
// $archivo = $_FILES['archivo']['name'];
// $tipo = $_FILES['archivo']['type'];
// $archivo_tamano = $_FILES['archivo']['size'];

//Anadiendole 1 minuto al tiempo 
$parsedHI = strtotime($hora_inicio);
$parsedHF = strtotime($hora_final);

//Añadiendole y restandole a la hora recibida
$parsedHIP = ($parsedHI + 60);
$parsedHFM = ($parsedHF - 60);

//Conviertiendo la hora y minutos recibidos a hora valida (Hora y minutos)
$inicioHoraMMA = date("H:i", $parsedHIP);
$finHoraMME = date("H:i", $parsedHFM);

//Fecha y hora completas SOLO PARA REALIZAR LAS CONSULTAS, YA LA HORA DE INICIO TIENE UN MINUTO MAS Y LA FINAL TIENE UN MINUTO MENOS
$fecha_hora_inicioR = $fecha_inicio . " " . $inicioHoraMMA;
$fecha_hora_finalR = $fecha_final . " " . $finHoraMME;

$fech_hora_inicio = $fecha_inicio . " " . $hora_inicio;
$fech_hora_final = $fecha_final . " " . $hora_final;

$sql = "SELECT * FROM publicidad WHERE ( fecha_hora_inicio BETWEEN '$fecha_hora_inicioR' AND '$fecha_hora_finalR') OR
( fecha_hora_final  BETWEEN '$fecha_hora_inicioR' AND '$fecha_hora_finalR')";
$verificar_horario = mysqli_query($mysqli, $sql);
$resultado_rows = mysqli_num_rows($verificar_horario);

//CONSULTA PARA VERIFICAR EL DUPLICADO DE INSERCIONES DE REGISTROS O YA EXISTENTES DENTRO DE LA BASE DE DATOS
$sql2 = "SELECT * FROM publicidad WHERE (fecha_hora_inicio BETWEEN'$fech_hora_inicio' AND '$fech_hora_final') OR 
(fecha_hora_final BETWEEN '$fech_hora_inicio' AND '$fech_hora_final')";
$verificar_duplicado = mysqli_query($mysqli, $sql2);
$resultado_rows2 = mysqli_num_rows($verificar_duplicado);

if ($resultado_rows > 0) {

    $lista = "<ul>"; //Ul lista
    echo "El registro de la publicidad en curso mostro lo siguiente.<br><br>";
    echo "Se encontraron " . $resultado_rows . " publicidades dentro del horario seleccionado.<br><br>";
    while ($fila = mysqli_fetch_array($verificar_horario)) {
        $titulo_publicidad = $fila["titulo_publicidad"];
        $fecha_hora_inicio = $fila["fecha_hora_inicio"];
        $fecha_hora_final = $fila["fecha_hora_final"];

        // if ($fech_hora_inicio == $fila["fecha_hora_inicio"]) {
        //     # code...
        //     echo "Existe un registro con la misma hora de inicio dentro de la base de datos";
        //     die();
        // }else{
        //     echo "No se ha reconocido nada";
        // }

        $lista .= "<li>
        <b>TITULO DE LA PUBLICIDAD</b><br> $titulo_publicidad<br>
        <b>FECHA DE INICIO Y HORA DE INICIO</b><br> $fecha_hora_inicio<br> 
        <b>FECHA DE VENCIMIENTO Y HORA DE VENCIMIENTO</b><br> $fecha_hora_final</li>
        <br>
        ";
    }
    $lista .= "</ul>";
    echo $lista . "
   $fecha_hora_inicioR $fecha_hora_finalR
    <b>NOTA</b>
    <br><b>Considere elegir una fecha y hora distinta, o un horario libre para guardar su publicidad.</b>";
} 
////// ME QUEDE EN ESTA VALIDACION 04:27PM DEL 15/07/2021 

else if ($resultado_rows2 > 0) {
    echo "Existe un registro con la misma hora y fecha.<br>Corrija la fecha y hora de inicio y final para evitar registros duplicados.";
    die();
} else {
    //  echo "LA FECHA Y EL HORARIO SE ENCUENTRA LIBRE.<br>Ha pasado las validaciones del horario y fecha.";
    //  echo "No se encuentra ningun registro dentro de la base de datos";
    echo "Fecha y hora de inicio: " . $fech_hora_inicio . "<br>";
    echo "Fecha y hora de final: " . $fech_hora_final;
    echo "<br>";

    if (empty($titulo)) {
        echo "El titulo de publicidad esta vacio.";
    } else if (empty($fecha_inicio)) {
        echo "La fecha de inicio esta vacia.";
    } else if (empty($hora_inicio)) {
        echo "La hora de inicio se encuentra vacia.";
    } else if (empty($fecha_final)) {
        echo "La fecha final se encuentra vacia.";
    } else if (empty($hora_final)) {
        echo "La hora final se encuentra vacia.";
    } else if (empty($fech_hora_inicio)) {
        echo "Fecha Hora Inicial es requerida.";
    } else if (empty($fech_hora_final)) {
        echo $fech_hora_final;
        echo "Fecha Hora Final es requerido.";
    } else if (empty($fk_sucursal)) {
        echo "Sucursal es requerida.";
    } else if (empty($fk_dispositivo)) {
        echo "Dispositivo es requerido.";
    } else if ($fech_hora_inicio > $fech_hora_final) {
        echo "Fecha hora final menor a la inicial, ingresa una fecha valida nuevamente.";
    } else if ($fech_hora_inicio == $fech_hora_final) {
        echo $fech_hora_inicio . "<br>";
        echo $fech_hora_final;
        echo "";
        echo "Las fechas son identicas, por favor verifica las fechas.";
    } else if ($_FILES['archivo']['name'] != null) { //ESTA LINEA IDENTIFICA QUE EL FILE TENGA NOMBRE OSEA QUE NO ESTE VACIO Y TAMBIEN QUE CONTENGA TEXTO


        // echo "Hay archivo prro";
        if ($tipo == 'image/jpg' || $tipo == 'image/png' || $tipo == 'image/jpeg' || $tipo == 'image/gif') {
            // echo "Es una imagen prro";
            $archivo = $_FILES["archivo"]["name"];
            $archivo_ext = explode(".", $_FILES["archivo"]["name"]);
            $archivo_endext = end($archivo_ext);



            $archivo_name = strtolower(md5($archivo) . '.' . $archivo_endext);
            // echo $archivo_name;

            $ruta = $_FILES['archivo']['tmp_name'];
            $archivo_tamano = $_FILES['archivo']['size'];
            $destino = "../../multimedia/imagen/" . $archivo_name;
            copy($ruta, $destino);
            $extension_archivo = str_replace("image/", "", $tipo);
            $tipo_archivo = "imagen";


            $sql = $sql = "INSERT INTO publicidad(titulo_publicidad,url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,estatus,texto, fk_sucursal,fk_dispositivo)
                VALUES('$titulo','$destino','$extension_archivo','$tipo_archivo','$fech_hora_inicio','$fech_hora_final',1,'$texto','$fk_sucursal','$fk_dispositivo')";

            $resultado = mysqli_query($mysqli, $sql);

            if ($resultado > 0) {
                echo "Imagen guardada exitosamente.";
            } else {
                echo "Ocurrio un error al guardar la imagen.";
            }
        } else if ($tipo == 'video/mp4' || $tipo == 'video/avi' || $tipo == 'video/flv' || $tipo == 'video/mov' || $tipo == 'video/wmv' || $tipo == 'video/H.264' || $tipo == 'video/XVID' || $tipo == 'video/RM') {
            echo "Hay un video prro!!";
            $archivo = $_FILES["archivo"]["name"];
            $ruta = $_FILES["archivo"]["tmp_name"];
            $destino = "../../multimedia/video/" . $archivo;
            copy($ruta, $destino);
            $extension_archivo = str_replace("video/", "", $tipo);
            $tipo_archivo = "video";

            $sql = $sql = "INSERT INTO publicidad(titulo_publicidad,url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,estatus,texto, fk_sucursal,fk_dispositivo)
             VALUES('$titulo','$destino','$extension_archivo','$tipo_archivo','$fech_hora_inicio','$fech_hora_final',1,'$texto','$fk_sucursal','$fk_dispositivo')";

            $resultado = mysqli_query($mysqli, $sql);

            if ($resultado > 0) {
                echo "Video guardado exitosamente.";
            } else {
                echo "Ocurrio un error.";
            }
        } else if ($tipo == 'audio/mpeg' || $tipo == 'audio/mp3' || $tipo == 'audio/wav' || $tipo == 'audio/midi' || $tipo == 'audio/aac' || $tipo == 'audio/flac' || $tipo == 'audio/AIFF') {
            echo "Hay un audio prro!!";
            $archivo = $_FILES["archivo"]["name"];
            $ruta = $_FILES["archivo"]["tmp_name"];
            $destino = "../../multimedia/audio/" . $archivo;
            copy($ruta, $destino);
            $extension_archivo = str_replace("audio/", "", $tipo);
            $tipo_archivo = "audio";

            $sql = $sql = "INSERT INTO publicidad(titulo_publicidad,url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,estatus,texto, fk_sucursal,fk_dispositivo)
             VALUES('$titulo','$destino','$extension_archivo','$tipo_archivo','$fecha_hora_inicio','$fecha_hora_final',1,'$texto','$fk_sucursal','$fk_dispositivo')";

            $resultado = mysqli_query($mysqli, $sql);

            if ($resultado > 0) {
                header("Location: ../cargar_publicidad.php?success=Guardado exitosamente!!");
            } else {
                header("Location: ../cargar_publicidad.php?error=Ocurrio un error&$datos_publicidad");
            }
        } else {
            echo "Formato no valido";
        }
    } else {
        include '../php/conexion.php';
        // echo "Es un texto";
        $tipo_archivo = "texto";
        $extension_archivo = "txt";
        $texto = $_POST['texto'];

        $str = $texto;
        $txtlenght = strlen($str);
        $titulo = strtoupper($titulo);
        if ($txtlenght < 5) {
            echo "El texto tiene que ser mayor a 5 caracteres";
        } else {
            $sql = "INSERT INTO publicidad(titulo_publicidad,url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,estatus,texto, fk_sucursal,fk_dispositivo)
             VALUES('$titulo','','$extension_archivo','$tipo_archivo','$fech_hora_inicio','$fech_hora_final',1,'$texto','$fk_sucursal','$fk_dispositivo')";
            $resultado = mysqli_query($mysqli, $sql);

            if ($resultado > 0) {
                echo "Se ha guardado el texto exitosamente.";
            } else {
                echo "Ocurrio un Error.";
            }
        }
    }
}































    // if(empty($titulo)){
    //     echo "El titulo esta vacio es muy corto.";
    // }else if(empty($fecha_inicio)){
    //     echo "La fecha y hora de inicio estan vacias.";
    // }else if(empty($fecha_final)){
    //     echo "La fecha y hora de vencimiento estan vacias.";
    // }else if($fecha_inicio == $fecha_final){
    //     echo "La fecha de inicio y la fecha final son iguales.";
    // }else if($fecha_hora_inicio > $fecha_hora_final){
    //     echo "La fecha y hora de inicio son mayores a la fecha y hora final";
    // }else if($fecha_hora_inicio == $fecha_hora_final){
    //     echo "La fecha, hora de inicio son iguales a la fecha, hora de vencimiento.";
    // }else if(empty($hora_inicio)){
    //     echo "La hora de inicio esta vacia.";
    // }else if(empty($hora_final)){
    //     echo "La hora de vencimiento esta vacia";
    // }else if(empty($fk_sucursal)){
    //     echo "Selecciona una sucursal.";
    // }else if(empty($fk_dispositivo)){
    //     echo "Selecciona un dispositivo.";
    // }