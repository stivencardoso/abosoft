<?php 
session_start();
include("session.php");
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id'";
include("../conexion/cn.php");
$caso  = $_SESSION['caso'];
$variable = "SELECT * FROM caso WHERE id_caso = '$caso' and estado_fk = 1";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      .pie{
        width: 350px;
        height: 350px;
      } 
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perfil abogado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/final.css">
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
<div class="row d-flex justify-content-center" style="margin-top: 2%;">
      <form class="col-11 p-3 mb-2 bg-white text-dark rounded" method="POST">
        <div style="margin: 3%;">
        <?php $resultado = mysqli_query($bd, $variable);
                while($row=mysqli_fetch_assoc($resultado)) {?>
            <h4>Nombre del caso:</h4>
            <h4><textarea class="form-control" name="nombre_caso"><?php echo $row['nombre_caso']; }?></textarea></h4>
            <h6>Informacion del caso</h6>
            <p class="border-bottom fw-semibold">Cliente:</p>
            <?php 
            $primero = "SELECT * FROM caso_usuario WHERE caso_fk = '$caso'";
            $xd = mysqli_query($bd, $primero);
            while($rox=mysqli_fetch_assoc($xd)) {
                $sl = $rox['usuario_fk'];
                $user = "SELECT * FROM usuarios WHERE identificacion = '$sl' and rol_fk = 4";
                $xd1 = mysqli_query($bd, $user);
                while($rox1=mysqli_fetch_assoc($xd1)) {?>
                    <p style="margin-left: 2%;"><?php echo $rox1['nombres']?> <?php echo $rox1['apellidos']?></p>
            <?php    }
            }
            ?>
            <p>Descripcion:</p>
            <?php
                $resultado = mysqli_query($bd, $variable);
                while($row=mysqli_fetch_assoc($resultado)) {?>
                            <textarea  class="form-control col-12 p-3 mb-2 bg-light text-dark" name="descripcion" style="text-align: justify;"><?php echo $row['descripcion']?></textarea>
            <?php } ?>
            <div class="text-end">
                    <input class="btn btn-success shadow" type="submit" name="actualizar" value="actualizar">
            </div>
            <?php 
                if(isset($_REQUEST['actualizar'])){
                    $descripcion = $_POST['descripcion'];
                    $nombre_caso = $_POST['nombre_caso'];
                    $finalizar = "UPDATE caso SET descripcion='$descripcion', nombre_caso='$nombre_caso' WHERE id_caso='$caso'";
                    $validando = mysqli_query($bd, $finalizar);
                    if($validando){
                        echo "<script>alert('se ha cambiado la descripcion del caso con exito');window.location='abogado_proceso_informacion.php?id_caso=$caso'</script>";
                    }else{
                        echo "<script>alert('No se pudo realizar los cambios');window.location='abogado_proceso_informacion.php?id_caso=$caso'</script>";
                    }
                }
                ?>
      </form>
</div>
<script src="../js/cerrarsesion.js"></script>
</body>
</html>