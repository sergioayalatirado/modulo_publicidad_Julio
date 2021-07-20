<?php
/////FUNCIONA LA SUBIDA DE IMAGENES Y SUBIDA DE VIDEOS - FALTA SUBIR AUDIOS
    if(isset($_POST['crear'])){
        include "../conexion.php";
        
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        //SE DETECTA E IMPRIME EL TIPO DE ARCHIVO QUE SE SUBE
        // echo $tipo;

        /////////////////////////////////////////////////////////////////////////////////////////////////FALTA VALIDAR EL TAMANO MAXIMO DE SUBIDA DE ARCHIVOS AL SERVIDOR
        if($tipo=='image/jpg' || $tipo=='image/png' || $tipo=='image/jpeg' || $tipo=='image/gif' || $tipo=='video/mp4' || $tipo=='video/avi' || $tipo=='video/flv' || $tipo=='video/mov' || $tipo=='video/wmv'|| $tipo=='video/H.264' || $tipo=='video/XVID'|| $tipo=='video/RM' || $tipo=='audio/mpeg' || $tipo=='audio/mp3' || $tipo=='audio/wav' || $tipo=='audio/midi' || $tipo=='audio/aac' || $tipo=='audio/flac' || $tipo=='audio/AIFF')
        {   
            $titulop = validate($_POST['titulo_publicidad']);
            $texto = validate($_POST['texto']);
            $fhi = validate($_POST['fecha_hora_inicio']);
            $fhf = validate($_POST['fecha_hora_final']);
            $fks = validate($_POST['fk_sucursal']);
            $fkd = validate($_POST['fk_dispositivo']);
            $texto= validate($_POST['texto']);
                
            //FECHAS SIN LA LETRA T
            $fhi_vd = str_replace("T", " ", $fhi, $count);
            $fhf_vd = str_replace("T", " ", $fhf, $count);     
        
            $datos_subida = 'Titulo='.$titulop. ' Texto='.$texto. ' FechaHoraInicio='.$fhi.'&FechaHoraFinal='.$fhf;

                        if(empty($titulop))
                        {
                            header("Location: ../publicy_0.php?error=Titulo es requerido&$titulop");
                        }
            
                        else if(empty($texto))
                        {
                            header("Location: ../publicy_0.php?error=Descripcion es requerida$texto");
                        }

            //IMAGEN
            else if($tipo=='image/jpg' || $tipo=='image/png' || $tipo=='image/jpeg' || $tipo=='image/gif')
                        {
                            $archivo = $_FILES["archivo"]["name"];
                            $ruta = $_FILES['archivo']['tmp_name'];
                            $destino="../multimedia/".$archivo; //MODIFICAR, ESTA RUTA ES UNA PRUEBA DEL 08/06/2021
                            copy($ruta,$destino);
                            $extension_archivo = str_replace("image/"," ",$tipo,$count);
                            $tipo_archivo = "imagen";
                            
                            $sql = "INSERT INTO publicidad(titulo_publicidad,url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,estatus,texto,fk_sucursal,fk_dispositivo)
                                VALUES('$titulop','$destino','$extension_archivo','$tipo_archivo','$fhi','$fhf',1, '$texto','$fks','$fkd')";
                            
                            $resultado = mysqli_query($mysqli,$sql);
    
                            if($resultado > 0)
                            {
                                header("Location: ../publicy_0.php?success=Guardado exitosamente!!");
                            }

                            else
                            {
                                header("Location: ../publicy_0.php?error=Ocurrio un Error&$datos_subida");
                            }
                        }
            /////////////////////////////////////////////////////////////////////////////////////////////////

            //VIDEO
            else if($tipo=='video/mp4' || $tipo=='video/avi' || $tipo=='video/flv' || $tipo=='video/mov' || $tipo=='video/wmv'|| $tipo=='video/H.264' || $tipo=='video/XVID'|| $tipo=='video/RM')
                        {
                            $archivo = $_FILES["archivo"]["name"];
                            $ruta = $_FILES['archivo']['tmp_name'];
                            $destino="../multimedia/".$archivo; //MODIFICAR, ESTA RUTA ES UNA PRUEBA DEL 08/06/2021
                            copy($ruta,$destino);
                            $extension_archivo = str_replace("video/"," ",$tipo,$count);
                            $tipo_archivo = "video";

                            $sql = "INSERT INTO publicidad(titulo_publicidad,url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,estatus,texto, fk_sucursal,fk_dispositivo)
                                VALUES('$titulop','$destino','$extension_archivo','$tipo_archivo','$fhi','$fhf',1,'$texto','$fks','$fkd')";
                            
                            $resultado = mysqli_query($mysqli,$sql);
    
                            if($resultado > 0)
                            {
                                header("Location: ../publicy_0.php?success=Guardado exitosamente!!");
                            }

                            else
                            {
                                header("Location: ../publicy_0.php?error=Ocurrio un Error&$datos_subida");
                            }

                        }

            /////////////////////////////////////////////////////////////////////////////////////////////////
            //AUDIO - YA FUNCIONA XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
            else if($tipo=='audio/mpeg' || $tipo=='audio/mp3' || $tipo=='audio/wav' || $tipo=='audio/midi' || $tipo=='audio/aac' || $tipo=='audio/flac' || $tipo=='audio/AIFF')
                        {
                            $archivo = $_FILES["archivo"]["name"];
                            $ruta = $_FILES['archivo']['tmp_name'];
                            $destino="../multimedia/".$archivo; //MODIFICAR, ESTA RUTA ES UNA PRUEBA DEL 08/06/2021
                            copy($ruta,$destino);
                            $extension_archivo = str_replace("audio/"," ",$tipo,$count);
                            $tipo_archivo = "audio";

                            $sql = "INSERT INTO publicidad(titulo_publicidad,url_archivo,extension_archivo,tipo_archivo,fecha_hora_inicio,fecha_hora_final,estatus,fk_sucursal,fk_dispositivo)
                                VALUES('$titulop','$destino','$extension_archivo','$tipo_archivo','$fhi','$fhf',1, '$fks','$fkd')";
                            
                            $resultado = mysqli_query($mysqli,$sql);
    
                            if($resultado > 0)
                            {
                                header("Location: ../publicy_0.php?success=Guardado exitosamente!!");
                            }

                            else
                            {
                                header("Location: ../publicy_0.php?error=Ocurrio un Error&$datos_subida");
                            }
                        }
            else
                        {
                            $nvf= 'Formato no valido';
                            header("Location: ../publicy_0.php?error=$nvf");
                            // echo " | Error: Esto no es un archivo valido";
                        }
                    }

        // echo $tipo;
/////////////////////////////////////////////////////////////////////////////////

        // $titulop = validate($_POST['titulo_publicidad']);
        // $texto = validate($_POST['texto']);
        // $fhi = validate($_POST['fecha_hora_inicio']);
        // $fhf = validate($_POST['fecha_hora_final']);

                }
        
    