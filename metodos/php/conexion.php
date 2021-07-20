<?php
    //Datos del servidor
    $host_db= "localhost";
    $user_db= "root";
    $pass_db= "";
    $db_name= "mydb_publicidad";

    $mysqli = mysqli_connect($host_db, $user_db,$pass_db, $db_name);

    if(!$mysqli){
        echo "Conexion fallida";
    }