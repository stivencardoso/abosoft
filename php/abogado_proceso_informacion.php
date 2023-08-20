<?php 
session_start();
include("session.php");
$_SESSION['caso']  = $_GET['id_caso'];
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id'";
include("../conexion/cn.php");
$caso  = $_GET['id_caso'];
$variable = "SELECT * FROM caso WHERE id_caso = '$caso' and estado_fk = 1";
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
      <div class="col-11 p-3 mb-2 bg-white text-dark rounded">
      <div style="margin: 3%;">
            <a style="margin-bottom: 2%;" class="btn btn-primary" href="administracion_procesos.php" role="button">Volver</a>
        <?php $resultado = mysqli_query($bd, $variable);
                while($row=mysqli_fetch_assoc($resultado)) {?>
            <h4>Nombre del caso: <?php echo $row['nombre_caso']; }?></h4>
            <h6 class=" fw-bold">Informacion del caso</h6>
            <div class="row">
              <div class="col-6">
              <p class="border-bottom fw-semibold">Cliente:</p>
              <?php 
              $primero = "SELECT * FROM caso_usuario WHERE caso_fk = '$caso'";
              $xd = mysqli_query($bd, $primero);
              while($rox=mysqli_fetch_assoc($xd)) {
                  $sl = $rox['usuario_fk'];
                  $_SESSION['cliente'] = $sl;
                  $user = "SELECT * FROM usuarios WHERE identificacion = '$sl' and rol_fk = 4";
                  $xd1 = mysqli_query($bd, $user);
                  while($rox1=mysqli_fetch_assoc($xd1)) {?>
                      <p style="margin-left: 2%;"><?php echo $rox1['nombres']?> <?php echo $rox1['apellidos']?></p>
              <?php    }
              }
              ?>
              </div>
              <div class="col-6">
                          <p class="border-bottom fw-semibold">Abogado:</p>
              <?php 
              $primero = "SELECT * FROM caso_usuario WHERE caso_fk = '$caso'";
              $xd = mysqli_query($bd, $primero);
              while($rox=mysqli_fetch_assoc($xd)) {
                  $sl = $rox['usuario_fk'];
                  $user = "SELECT * FROM usuarios WHERE identificacion = '$sl' and rol_fk = 2";
                  $xd1 = mysqli_query($bd, $user);
                  while($rox1=mysqli_fetch_assoc($xd1)) {?>
                      <p style="margin-left: 2%;"><?php echo $rox1['nombres']?> <?php echo $rox1['apellidos']?></p>
              <?php    }
              }
              ?>
              </div>
            </div>
            <p class="border-bottom fw-semibold">Descripcion:</p>
            <?php
                $resultado = mysqli_query($bd, $variable);
                while($row=mysqli_fetch_assoc($resultado)) {?>
                            <p class="col-12 p-3 mb-2 bg-light text-dark" style="text-align: justify;"><?php echo $row['descripcion']?><p>
            <?php } ?>
            <div class="row">
                    <a style="margin:1%;" class="btn btn-primary link-offset-2 link-underline link-underline-opacity-0 col-12 col-sm-6 col-md-5 col-lg-3" href="../calendarioeventos/index.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                            <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/></svg>
                            agregar un evento para este caso
                    </a>
                    <a style="margin:1%;" class="btn btn-primary link-offset-2 link-underline link-underline-opacity-0 col-12 col-sm-6 col-md-5 col-lg-3" href="index.php?case=<?php echo $caso ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                            <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/></svg>
                        ver repositorio de archivos
                    </a>
                    <a style="margin:1%;" class ="btn btn-primary link-offset-2 link-underline link-underline-opacity-0 col-12 col-sm-6 col-md-4" href="abogado_caso_actualizar.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg> cambiar informacion del caso
                    </a>
                <div>
                <br>
                <br>
                <div class="text-end">
                    <a class="btn btn-danger" href="abogado_caso_eliminar.php" role="button">Eliminar Caso</a>
                    <a class="btn btn-success" href="abogado_caso_finalizar.php" role="button">Finalizar Caso</a>
                </div>
            </div>
            </div>
      </div>
</div>
<script src="../js/cerrarsesion.js"></script>
</body>
<?php include "agregar3.php"; ?>
</html>