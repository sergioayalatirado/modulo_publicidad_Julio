<?php include("../php/conexion.php");
?>
<?php include ("../php/actualizar_sucursal.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Sucursal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="container">
            <form action="../php/actualizar_sucursal.php" 
            method="post" id="forma-sucursal" name="forma-sucursal">

            <h4 class="display-4 text-center">Actualizar sucursal</h4><hr><br>

            <?php if(isset($_GET['error'])){?>    

            <div class="alert alert-danger" role="alert">
                <?php echo $_GET['error']; ?>
            </div>
            <?php } ?> 
            <!-- //PERMITE SACAR EL ERROR QUE SE ENCUENTRE POR VIDA GET -->
            
            <?php if(isset($_GET['success'])){?>    
            <div class="alert alert-success" role="alert">
                <?php echo $_GET['success']; ?>
            </div>
            <?php } ?> 

            <div class="form-group">
                <label for="name">Nombre de sucursal</label>
                <input type="text" 
                class="form-control" 
                id="sucursal" 
                name="sucursal"
                value="<?=$row['nombre_sucursal']?>"
                placeholder="Ingresa el nombre o identificador de la sucursal" >
            </div>
            <!-- onkeypress="return soloLetras(event)" onpaste="return false;" -->
            <i id="mensaje_sucursal" style="color:red;" class="text-center"></i>

            <div class="form-group"><br>
                <label for="tipo_sucursal" >Tipo de sucursal</label><br>
                <label for="">Tipo de sucursal actual: <?=$row['tipo_sucursal']?></label>
                <select name="tipo_sucursal" id="tipo_sucursal" class="form-control">
                    <option value="matriz">Matriz</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
            <input type="text"
                    name="id_sucursal"
                    value="<?=$row['id_sucursal']?>"
                    hidden id="id_sucursal">
            <br>
            <button type="submit" 
                    class="btn btn-primary"
                    name="actualizar">Actualizar sucursal</button>
                    <a href="lista_sucursales.php"  class=" btn btn-secondary" name=>Lista de sucursales</a>
            </form>
        </div>
            <!-- Modal -->
    <div class="modal fade" id="avisoSucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                        <div id="div_resultado" name="div_resultado"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar aviso</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../../js/editar_sucursal.js"></script>
</body>
</html>