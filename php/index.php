<?php 
session_start();
include("session.php");
$caso  = $_SESSION['caso'];
include("../conexion/cn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repositorio de Documentos</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-black">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Abogado</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="../calendarioeventos/index.php">calendario de eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_formulario.php">Registrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_clientes.php">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_procesos.php">Procesos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_descripcion.php">Perfil Abogado</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 4%;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg> Usuario
            </a> 
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="abogado_perfil.php">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item salir" href="cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container p-3 mb-2 bg-body text-body" style="margin-top: 2%;">
        <div class="col-sm-12">
            <h2 style="text-align: center;">Repositorio de archivos del caso</h2>
            <br>
            <a class="btn btn-primary" style="margin-bottom: 1%;" href="abogado_proceso_informacion.php?id_caso=<?php echo $caso; ?>" role="button">volver</a>
            <br>
    <?php if(isset($_GET['formulario'])){ ?>
            <form action="upload.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Usuario</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>

                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Descripcion</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" required>
                        </div>
                    </div>
                </div>




                <div class="col-12">
                    <label for="yourPassword" class="form-label">Archivo (WORD & PDF)</label>
                    <input type="file" name="archivo" id="archivo" class="form-control" required>

                </div>

                <br>

                <div class="modal-footer">
                    <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>
                    <button type="submit"  style="margin-left: 1%;" class="btn btn-primary" id="register" name="registrar">Guardar</button>
                </div>
                <br>
                <embed class="text-center"id="vistaprevia" type="application/pdf" width="100%" height="500px">
                </div>

            </form>
 <?php }else{?>
            <form class="col-12 text-start" method="get">
                <input class="btn btn-primary" type="submit" name="formulario" value="nuevo_archivo">
            </form>
            <br>
            <br>
            <br>

            <div class="container">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Descripcion</th>
                            <th>Archivo</th>
                            <th>Descargar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       $consulta = mysqli_query($bd, "SELECT * FROM documento WHERE id_caso = $caso");
                       while ($fila = mysqli_fetch_assoc($consulta)):
                            $i = 1;
                            $i = $i++;

                       ?>
                            <tr>
                            <td><?php echo $i ;?></td>
                            <td><?php echo $fila['nombre'] ;?></td>
                            <td><?php echo $fila['descripcion'] ;?></td>
                            <td><?php echo $fila['archivo'] ;?></td>
                                <td>
                                    <a href="download.php?id= <?php echo $fila['id'] ;?>" class="btn btn-primary">
                                  <i class="fas fa-download"></i></a>
                                </td>
                                <td>
                                    <a href="archivo_eliminar.php?id= <?php echo $fila['id'] ;?>" class="btn btn-danger eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg></a>
                                </td>
                                <?php endwhile ;?>

                            </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <?php }?>
<script src="../js/main.js"></script>
</body>
<style>
    a {
        text-decoration: none;
    }

    .s {
        padding-top: 50px;
        text-align: center;
    }
</style>

</html>