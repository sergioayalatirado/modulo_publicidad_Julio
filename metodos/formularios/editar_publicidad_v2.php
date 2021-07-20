<?php 
    include "../php/editar_publicidad.php";
    include "../php/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar publicidad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <!-- <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <script src="js/bootstrap-datetimepicker.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="undefined" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="undefined" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.esm.min.js" integrity="undefined" crossorigin="anonymous"></script>
    <script>
    
    </script> -->
</head>
<body>
        <?php 
            $phpfemod = $row['fecha_modificacion'];
        ?>


        <div class="container">
            <form action="../php/editar_publicidad_v2.php" method="post" enctype="multipart/form-data">
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

               <hr>
                <div class="form-group">
                   <label for="titulo" class="display-6 text-center"> Título de la publicidad</label>
                    <br><br><input type="text" class="form-control" id="titulo" name="titulo_publicidad" value="<?=$row['titulo_publicidad'] ?>" required>
                    <br>
                </div>
                
                
                <div class="form-group">
                    <label for="texto_descripcion" name="texto_descripciont" class="display-6 text text-center ">Descripción</label><br><br>
                    <!-- <?php 
                    
                        if(!($row['texto']=null || $row['texto']=='')){
                            echo "<div class='alert alert-success' role='alert'>Se encuentra texto en nuestros registros</div>";
                            
                        }else{
                            
                            echo "<div class='alert alert-danger' role='alert''>No se encuentra texto en nuestros registros</div>";
                        }
                    ?> -->
                    <textarea name="texto" id="texto" cols="30" rows="10" class="form-control" required><?php echo $row['texto']; ?></textarea>
                    <br>
                 </div>
                 <?php
                    $fhi = $row['fecha_hora_inicio'];
                    $fhf = $row ['fecha_hora_final'];
                    
                    $fecha_inicio = $row['fecha_hora_inicio'];
                    $hr_inicio = explode(" ",$fecha_inicio);
                    $fecha_inicio1 = $hr_inicio[0];
                    $fi_dt = new DateTime($fecha_inicio1);
                    echo $fi_dt->format('Y-m-d');
                    echo '<br>';
                    $fecha_final = $row['fecha_hora_final'];
                    $hr_final = explode(" ", $fecha_final);
                    $fecha_final1 = $hr_final[0];
                    $ff_dt = new DateTime($fecha_final1);
                    echo $ff_dt->format('Y-m-d');
                    // $fecha_inicio = explode("/")
                 ?>
                 
               
                 <div class="form-group">
                    <label for="fhl" name="fecha_hora_inicio" class="text-center display-6">Fecha y Hora de Inicio</label><br>
                    <label for=""><h6>Fecha de inicio <br> <?php echo $fhi ?></h6></label>
                    <br><input type="date" size="5" class="form-control" required name="fecha_inicio" id="fecha_inicio" value="<?php echo $fi_dt->format('Y-m-d');?>"><br>
                    <label for=""><h6>Hora de inicio</h6></label><br>
                    <input type="time" class="form-control" required name="hora_inicio" id="hora_inicio" value="<?php echo $hr_inicio[1];?>"><br>
                </div>
                        <hr>
                <div class="form-group">
                    <label for="" class="display-6 text-center">Fecha y Hora de término</label><br>
                    <label for=""><h6>Fecha y hora final (anterior): <br> <?php echo $fhf?></h6></label>
                    <br><input type="date" name="fecha_final" class="form-control" id="fecha_final" required value="<?php echo $ff_dt->format('Y-m-d');?>"> <br>
                    <label for=""><h6>Hora de termino</h6></label>
                    <input type="time" name="hora_final" id="hora_final" class="form-control" required value="<?php echo $hr_final[1];?>">
                    <hr>
                </div>

                <div class="form-group">
                    <label for="" class="display-6 text-center">Selecciona una sucursal</label><br>
                    <select name="fk_sucursal" id="fk_sucursal" class="form-control">
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
                    <select name="fk_dispositivo" id="fk_dispositivo" class="form-control">
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
                        $urlarch = $row['url_archivo'];
                        $tipo_archivo = $row['tipo_archivo'];
                        ?>
                        <?php $extension_archivo = str_replace("../","",$urlarch); ?>
                        <?php $extension_archivo?>
                    </h6>

                </div>
                    <br>
                <input type="text" value="<?php echo $row['id_publicidad']?>" name="id_publicidad" id="id_publicidad" hidden>
                <button type="submit" class="btn btn-primary"
                name="actualizar" text-center>Editar publicidad</button>
            </form>
    
    <input name="text" id="boton" readonly style="display:none" />

        </div>
</body>
</html>