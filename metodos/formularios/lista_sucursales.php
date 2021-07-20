<?php include "../php/leer_sucursales.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Sucursales disponibles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">

</head>
<body>
<div class="container">
            <div class="box">
                <h4 class="display-4 text-center">Lista de sucursales</h4><hr>

                <?php if(isset($_GET['success'])){?>    
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['success']; ?>
                </div>
                <?php } ?> 
                <?php if(mysqli_num_rows($resultado)) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        
                         
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de sucursal</th>
                        <th scope="col">Tipo de sucursal</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $i =0;
                          while($rows = mysqli_fetch_assoc($resultado)){
                          $i++;
                   ?>
                        <tr>
                        <th scope="row"><?=$i?></th>
                        <td><?php echo $rows['nombre_sucursal']; ?></td>
                        <td><?php echo $rows['tipo_sucursal']; ?></td>
                        <td>
                            <a href="../php/baja_sucursal.php?id=<?=$rows['id_sucursal']?>" 
                            class="btn btn-danger" name="id">Dar de baja</a><br><br>
                            <a href=""></a>
                            <a href="editar_sucursal.php?id=<?=$rows['id_sucursal']?>" 
                               class="btn btn-warning" name="id">Editar datos</a><br><br>
                            
                            <!-- <a href="php/baja_publicidad.php?id=<?=$rows['id_publicidad']?>" 
                               class="btn btn-danger">Eliminar publicidad</a> -->
                            </td>
                        </tr>
                        <?php } ?>  
                    </tbody>
                </table>
                <?php } ?>
                <div class="link-right">
                    <a href="../../modulo_publicidad/index.php" class="link-primary">Inicio</a>
                </div>
                <div class="link-right">
                    <a href="../formularios/agregar_sucursal.php" class="link-primary">Agregar sucursal</a>
                </div>
               
            </div>
        </div>  
    
</body>
</html>