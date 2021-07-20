<?php
include_once "../php/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir publicidad</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/estilo-formtxt.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/1.27.0/luxon.min.js" integrity="sha512-cQXElo4AdS11Wtr5GFBmliue0OBZIhJjcSOSmF3RASBNfJMrkhF/F5JknHUm9klwHLLVG5+oiV6INy/yjgYPoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <link href="bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> -->
    <!-- <script src="js/bootstrap-datetimepicker.min.js"></script> -->
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/js/popper.min.js">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="bootstrap/js/bootstrap.bundle.js"> -->
    <link rel="stylesheet" href="../../css/fontawesome/css/all.min.css">

    <!-- <script type="text/javascript">
        $(window).on("load",function() {
            $('#avisoPublicidad').modal('show');
        });
    </script> -->
</head>

<body>


    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" id="form_publicidad">

            <div class="form-group">
                <a href="../../modulo_publicidad/index.php">Inicio</a>
            </div>
            <!-- <div class="link-right">
                            <a href="crear_texto.php">Subir texto</a>
                </div> -->
            <label for="">NOTA 21/06/2021</label><br>
            <a href="">Revisar subida de publicidad sin algun archivo dentro del input tipo file</a><br>
            <a href="">Revisar que se reciban los valores de los input fechas y horas en el archivo php</a>
            <h4 class="display-4 text-center"> Subir nueva publicidad</h4>
            <hr><br>

            <?php if (isset($_GET['error'])) { ?>

                <div class="alert alert-danger" role="alert" align="center">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['success']; ?>
                </div>
            <?php } ?>

            <div class="form-group">
                <!-- Modificar la clase del alert para que desaparezca junto con lo del parrafo que esta dentro del js de insercion -->
                <label for="titulo" class="display-6 text-center"> Título de la publicidad</label>
                <br><br><input type="text" onkeypress="return soloLetras(event)" class="form-control" onpaste="return false;" id="titulo_publicidad" name="titulo_publicidad" value="<?php if (isset($_GET['titulo']))                                                                                                                                                                   echo ($_GET['titulo']); ?>">
                <i id="mensaje_titulo" class="alertas" role="alert alert-warning" style=" font-style: italic; color: red;"></i>
                <br>
            </div>

            <div id="time"></div>

            <label for="" class="text-center display-6">Fecha y hora de inicio</label><br>
            <br><input type="date" size="1" class="form-control" name="fecha_inicio" id="fecha_inicio"><br>
            <input type="time" size="1" class="form-control" name="hora_inicio" id="hora_inicio"><br>
            <label for="" class="text-center display-6">Fecha y hora de vencimiento</label><br><br>
            <input type="date" size="1" class="form-control" name="fecha_final" id="fecha_final"><br>
            <input type="time" size="1" class="form-control" name="hora_final" id="hora_final">

            <br>
            <div class="form-group">
                <label for="" class="display-6 text-center">Selecciona una sucursal</label>
                <select name="fk_sucursal" id="fk_sucursal" class="form-control" onpaste="return false;">
                    <option value="">----Seleccione una sucursal----</option>
                    <?php
                    $query = $mysqli->query("SELECT * FROM sucursal");
                    while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores['id_sucursal'] . '" name="fk_sucursal">' . $valores['nombre_sucursal'] . ' (' . $valores['tipo_sucursal'] . ')' . '</option>';
                    }
                    ?>
                </select>
                <i id="mensaje_sucursal" class="alert" style=" font-style: italic; color:red;" role="alert"></i>
                <hr>

                <label for="" class="display-6 text-center">Dispositivos disponibles</label><br>
                <select name="fk_dispositivo" id="fk_dispositivo" class="form-control" onpaste="return false;">
                    <option value="">----Seleccione un dispositivo----</option>
                    <?php
                    $query = $mysqli->query("SELECT * FROM dispositivo");
                    while ($valores = mysqli_fetch_array($query)) {
                        echo '<option value="' . $valores['id_dispositivo'] . '" name="fk_dispositivo">' . $valores['tipo_dispositivo'] . ' (' . $valores['nombre_dispositivo'] . ')' . '</option>';
                    }
                    ?>
                </select>
                <i id="mensaje_dispositivo" style=" font-style: italic; color:red;"></i>
                <hr>

            </div>
            <i id="aviso_contenido" style="font-style: italoc; color:red;"><br></i>
            <label for="">Selecciona una opcion</label>
            <button class="btn btn-danger" id="botonAccion">Incluir o solo texto</button>

            <div class="form-group d-none" id="sTexto">
                <script>

                </script>
                <p id="mensaje_solotexto" class="alert alert-info d-none" role="alert"> </p>
                <label for="texto_descripcion" name="texto" class="display-6 text text-center">Texto</label><br><br>
                <textarea type="text" size="5" name="texto" id="texto" onkeypress="return soloLetras(event)" cols="30" rows="10" class="form-control"><?php if (isset($_GET['texto_descripcion']))
                                                                                                                                                            echo ($_GET['texto_descripcion']); ?></textarea>
                <div id="area">
                    <h3 class="area">Si deseas leer un archivo de texto o extension .txt, suelta el archivo aqui.</h3>
                </div>
                <br>
            </div>

            <div class="form-group" id="noMedia">
                <label for="" class="display-6 text-center ">Audio/Imagen/Video</label><br>
                </h6>
                <i id="aviso_archivo" style="color: red;"></i>
                <i id="aviso_valido" style="color: green;"></i>
                <i id="aviso_invalido" style="color: red;"></i>

                <input type="file" class="form-control" name="archivo" id="archivo" accept="audio/*,video/*,image/*"><br>
                <hr><br>
                <div class="imagePreview" id="imagePreview"></div>
                <div id="audioPreview"></div>

            </div>
            <!-- <button type="submit" class="btn btn-primary" name="btn_validar" id="btn_validar" text-center>Crear nueva publicidad</button> -->
            <button type="submit" class="btn btn-primary my-2 aaaa" id="btn_validar">Crear nueva publicidad</button>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="avisoPublicidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="exampleModalLongTitle">AVISO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center"></div>
                    <div class="col-md">
                        <div id="respuesta" class=""></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar aviso</button>
                </div>
            </div>
        </div>
    </div>
    <!-- No cambiar el orden de los JS -->
    <script src="../../js/funciones.js"></script>
    <!-- <script src="js/verify_horario.js"></script> -->
    <script src="../../js/insercion_publicidad.js"></script>

</body>

</html>