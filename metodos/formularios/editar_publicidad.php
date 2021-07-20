<?php 
    include_once "../php/editar_publicidad.php";
    include_once "../php/conexion.php";
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar publicidad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="undefined" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="undefined" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.esm.min.js" integrity="undefined" crossorigin="anonymous"></script>
    
</head>
<body>
        <?php 
            $phpfemod = $row['fecha_modificacion'];
        ?>

    
        <div class="container">
            <form action="../php/editar_publicidad.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <a href="../../modulo_publicidad/index.php">Inicio</a>
                </div>
                <h4 class="display-4 text-center"> Editar publicidad</h4> <hr>

                <?php if(isset($_GET['error'])){?>

                <div class="alert alert-danger" role="alert" align="center">
                    <?php echo $_GET['error']; ?>
                </div>
                <?php }?>

                <?php if(isset($_GET['success'])){?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['success']; ?>
                    </div>
                <?php }?> 
                

                <h6 class="text-center"> <b> Fecha de creacion:</b> <br><?=$row['fecha_creacion']?> </h6>

                <?php 
                if(!($row["fecha_modificacion"]=null || $row["fecha_modificacion"]=="")){
                    echo "<h6 class='text-center'> <b> Fecha de modificacion: </b><br>$phpfemod</h6>";
    
                }
                ?>
                <?=$row['id_publicidad']?>

               <hr>
                <div class="form-group">
                   <label for="titulo" class="display-6 text-center"> Título de la publicidad</label>
                    <br><br><input type="text" class="form-control" id="titulo" name="titulo_publicidad" value="<?=$row['titulo_publicidad'] ?>" required>
                    <br>
                </div>
                
                
                <div class="form-group">
                    <label for="texto_descripcion" name="texto_descripciont" class="display-6 text text-center ">Texto</label><br><br>
                    <textarea name="texto" id="" cols="30" rows="10" class="form-control"><?php echo $row["texto"]; ?></textarea>
                    <br>
                 </div>
                 <?php
                    $fhi = $row['fecha_hora_inicio'];
                    $fhf = $row ['fecha_hora_final'];
                 ?>
               
                 <div class="form-group">
                    <label for="fhl" name="fecha_hora_inicio" class="text-center display-6">Fecha y Hora de Inicio</label><br>
                    <!-- <label for=""><h6>Fecha y hora de inicio (anterior): <br> <?php echo $fhi ?></h6></label> -->
                    <br><input type="datetime-local" size="5" class="form-control" required name="fecha_hora_inicio" value="<?=$row['fecha_hora_inicio'] ?>"><br><br>
                </div>
                        <hr>
                <div class="form-group">
                    <label for="" class="display-6 text-center">Fecha y hora de término</label><br>
                    <!-- <label for=""><h6>Fecha y hora final (anterior): <br> <?php echo $fhf?></h6></label> -->
                    <br><input type="datetime-local" name="fecha_hora_final" class="form-control" required value="<?=$row['fecha_hora_final'] ?>"> <br>
                    <hr>
                </div>
                <div class="form-group">
                    <label for="" class="display-6 text-center">Selecciona una sucursal</label><br>
                    <select name="fk_sucursal" id="" class="form-control">
                            <option value="">----Seleccione una sucursal----</option>
                                 <?php
                                $query = $mysqli -> query("SELECT * FROM sucursal ");

                                while ($valores = mysqli_fetch_array($query)) {
                                    // echo '<option value="'.$valores['id_sucursal'].'" name="fk_sucursal">'.$valores['nombre_sucursal'].'</option>';
                                    if ($valores["id_sucursal"] == $row["fk_sucursal"] ){
                                        echo "<option value='" . $valores["id_sucursal"] . "' selected='selected'>" . utf8_encode($valores["nombre_sucursal"]) . "</option>";
                                    }
                                    else {
                                        echo "<option value='" . $valores["id_sucursal"] . "'>" . utf8_encode($valores["nombre_sucursal"]) . "</option>";
                                    }
                                }
                                ?>
                    </select>
                                <hr>

                    <label for="" class="display-6 text-center">Dispositivos disponibles</label><br>
                   
                    <select name="fk_dispositivo" id="" class="form-control">
                            <option value="">----Seleccione un dispositivo----</option>
                            <?php
                                $query = $mysqli -> query("SELECT * FROM dispositivo");
                                while ($valores = mysqli_fetch_array($query)) {
                                    // echo '<option value="'.$valores['id_dispositivo'].'" name="fk_dispositivo">'.$valores['tipo_dispositivo'].' '.$valores['nombre_dispositivo'].'</option>';
                                
                                    if($valores["id_dispositivo"] == $row["fk_dispositivo"]){
                                        echo "<option value='" . $valores["id_dispositivo"] . "' selected='selected'>" . utf8_encode($valores["nombre_dispositivo"]) . "</option>";
                                    }else{
                                        echo "<option value='" . $valores["id_dispositivo"] . "'>" . utf8_encode($valores["nombre_dispositivo"]) . "</option>";
                                    }
                                }
                                ?>
                    </select>

                    <hr>
                </div>
                
                <div class="form-group">
                    <label for="" class="display-6 text-center">Audio/Imagen/Video</label><br>
                    <h6><br>
                        <b> 
                        </b>
                        <?php 
                        echo strtoupper('Ruta del archivo: '.$urlarch = $row['url_archivo']);
                        $tipo_archivo = $row['tipo_archivo'];
                        $extension_archivo = $row['url_archivo'];
                        ?>
                        <br><br>
                        <?php 
                        if(!($tipo_archivo=='imagen' || $tipo_archivo=='audio' || $tipo_archivo=='video')){
                            echo '<div class="alert alert-warning">Hay texto dentro de este registro.</div> ';
                        }else{
                            if($tipo_archivo=='imagen'){
                                echo '<div class="alert alert-warning">Hay imagen dentro de este registro.</div> ';
                            }else if($tipo_archivo =='audio'){
                                echo '<div class="alert alert-warning">Hay audio dentro de este registro.</div> ';
                            }else if($tipo_archivo =='video'){
                                echo '<div class="alert alert-warning">Hay video dentro de este registro.</div> ';
                            }else{
                            echo "<div class='alert alert-secondary'>No existe un archivo reconocible dentro de nuestros registros.</div>";
                            }
                        }
                        ?>
                    <input type="file" class="form-control" name="archivo" id="archivo" accept='audio/*,video/*,image/*' value=""><br>
                    </h6>
               

                  
                </div>
                    <br>
                <input type="text" hidden value="<?=$row['id_publicidad']?>" name="id">
                <button type="submit" class="btn btn-primary"
                name="actualizar" text-center>Actualizar publicidad</button>
            </form>
        </div>
</body>
</html>