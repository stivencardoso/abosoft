<?php 
session_start();
include("session.php");
$usuarios = "SELECT * FROM usuarios WHERE identificacion = $id";
include("../conexion/cn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/final.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-black">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Cliente</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="cliente_inicio.php">inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="../calendarioeventos/index.php">Calendario de eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="Cliente_procesos.php">procesos</a>
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
                <li><a class="dropdown-item" href="cliente_perfil.php">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item salir " href="cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="row justify-content-center " style="margin-top: 4%; margin-bottom: 6%">
  <div class="col-11 col-lg-9 p-3 mb-2 bg-light text-dark border border-4 rounded">
    <div class="row">
        <?php
       if(isset($_GET['actualizar'])){
        $resultado = mysqli_query($bd, $usuarios);
        while($row=mysqli_fetch_assoc($resultado)) {?>
        <form class="row" method="POST">
            <h3>Actualizacion de Datos Personales</h3>
            <div class="col-12 col-sm-6">
                <p>Nombres:</p>
                <input type="text" style="width: 90%; margin-left: 4%; margin-bottom: 2%;" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" style="margin-left: 4%;" value="<?php echo $row["nombres"]; ?> " name="nombres">
            </div>
            <div class="col-12 col-sm-6">
                <p>Apellidos</p>
                <input type="text" style="width: 90%; margin-left: 4%;" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" style="margin-left: 4%;" value="<?php echo $row["apellidos"]; ?> " name="apellidos">
            </div>
            <div class="col-12 col-sm-6">
                <p>Identificacion:</p>
                <input type="text"  style="width: 90%; margin-left: 4%;" class="form-control"aria-label="Username" aria-describedby="addon-wrapping" style="margin-left: 4%;" value="<?php echo $row["identificacion"]; ?> " disabled->
            </div>
            <div class="col-12 col-sm-6">
                <p>Correo Electronico:</p>
                <input type="text"  style="width: 90%; margin-left: 4%;" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" style="margin-left: 4%;" value="<?php echo $row["correo_electronico"]; ?> " name="correo_electronico">
            </div>
            <div class="col-12 col-sm-6">
                <p>Telefono:</p>
                <input type="text"style="width: 90%; margin-left: 4%;"  class="form-control" aria-label="Username" aria-describedby="addon-wrapping" style="margin-left: 4%;" value="<?php echo $row["telefono"]; ?> " name="telefono">
            </div>
            <div class="col-12 col-sm-6">
                <p>Direccion:</p>
                <input type="text" style="width: 90%; margin-left: 4%;" class="form-control" aria-label="Username" aria-describedby="addon-wrapping" style="margin-left: 4%;" value="<?php echo $row["direccion"]; ?> " name="dirreccion">
            </div>
            <div class="col-12 text-end" style="margin-top: 2%; margin-bottom: 2%;">
                <a class="btn btn-danger" href="administracion_perfil.php" role="button">Cancelar</a>
                <input  type="submit" class="submitBtn btn btn-success" value="actualizar" name="r_actualizar"> 
            </div>
        </form>
        <?php
                    if (isset($_REQUEST['r_actualizar'])) {
                        $nombres = $_POST['nombres'];
                        $apellidos = $_POST['apellidos'];
                        $dirreccion = $_POST['dirreccion'];
                        $correo_electronico = $_POST['correo_electronico'];
                        $telefono = $_POST['telefono'];
                        $actualizar = "UPDATE usuario SET nombres='$nombres', apellidos='$apellidos', dirreccion='$dirreccion', correo_electronico='$correo_electronico', telefono='$telefono' WHERE identificacion='$id'";
                        $resultado = mysqli_query($bd, $actualizar);
                        if($resultado){
                            echo "<script>alert('se han actualizado los datos');window.location='http://127.0.0.1/proyectofinal/php/mis_datos.php'</script>";
                        }
                    }
                ?>
    <?php }}else{ 
        $resultado = mysqli_query($bd, $usuarios);
        while($row=mysqli_fetch_assoc($resultado)) {
        ?>
        <h3 class="text-center">Datos Personales</h3>
        <form class="col-12 text-end" method="get">
            <input class="btn btn-secondary" type="submit" name="actualizar" value="actualizar">
        </form>
        <div class="col-12 col-sm-6">
            <p>Nombres:</p>
            <p class="p-3 mb-2 bg-dark-subtle text-emphasis-dark" style="margin-left: 4%;"><?php echo $row["nombres"]; ?></p>
        </div>
        <div class="col-12 col-sm-6">
            <p">Apellidos:</p>
            <p class="p-3 mb-2 bg-dark-subtle text-emphasis-dark" style="margin-left: 4%;"><?php echo $row["apellidos"]; ?></p>
        </div>
        <div class="col-12 col-sm-6">
            <p>Identificacion:</p>
            <p class="p-3 mb-2 bg-dark-subtle text-emphasis-dark" style="margin-left: 4%;"><?php echo $row["identificacion"]; ?></p>
        </div>
        <div class="col-12 col-sm-6">
            <p>Correo Electronico:</p>
            <p class="p-3 mb-2 bg-dark-subtle text-emphasis-dark" style="margin-left: 4%;"> <?php echo $row["correo_electronico"]; ?> </p>
        </div>
        <div class="col-12 col-sm-6">
            <p>Telefono:</p>
            <p class="p-3 mb-2 bg-dark-subtle text-emphasis-dark" style="margin-left: 4%;"> <?php echo $row["telefono"]; ?> </p>
        </div>
        <div class="col-12 col-sm-6">
            <p>Direccion:</p>
            <p class="p-3 mb-2 bg-dark-subtle text-emphasis-dark" style="margin-left: 4%;"> <?php echo $row["direccion"]; ?></p>
        </div>
        <?php
    } }
    ?>
    <br>
    <br>
</div>
    </div>
  </div>
</div>
</body>
</html>