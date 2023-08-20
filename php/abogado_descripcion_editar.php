<?php 
session_start();
include("session.php");
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id'";
$usuarios1 = "SELECT * FROM descripcion_abogado WHERE id_abogado = '$id'";
include("../conexion/cn.php");
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
<form class="row perfil border border-3 rounded p-3 mb-2 bg-body text-body"  style="margin: 2%;" method="post" enctype="multipart/form-data">
        <div class="col-4">
            <h2>Perfil</h2>
        </div>
        <div class="col-8 text-end">
            <a class="btn btn-primary" href="abogado_descripcion.php" role="button">Volver</a>
            <button type="submit" class="joinBtn btn btn-success" name="guardar">Actualizar</button>
        </div>
        <br>
        <br>
        <div class="col-12 text-start">
            Select image to upload:
            <div class="col-4">
              <input style="margin-bottom: 1%;" class=" form-control" type="file" name="image"/>
            </div>
        </div>
        <br>
        <br>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center">
            <?php $resultado1 = mysqli_query($bd, $usuarios1); 
                while($row=mysqli_fetch_assoc($resultado1)) {?>   
                    <img width="300" src="data:image/png;base64,<?php echo base64_encode($row["imagen"]);}?> ">
                    <button style="margin: 2%" type="submit" class="joinBtn btn btn-success" name="actualizar_foto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                    <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                    <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                    </svg> Actualizar foto </button>
        </div>
        <br>
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 " style="text-align: justify;">
            <?php $resultado = mysqli_query($bd, $usuarios); 
                while($row=mysqli_fetch_assoc($resultado)) { ?>
                    <h3>Abogado/a: <em><?php echo $row["nombres"];?> <?php echo $row["apellidos"];}?></em></h3>
            <?php $resultado1 = mysqli_query($bd, $usuarios1); 
                while($row=mysqli_fetch_assoc($resultado1)) {?>
                    <textarea class="form-control"style="width: 100%; height: 50%;"  name=descripcion value="<?php echo $row["descripcion"];?>"><?php echo $row["descripcion"]; ?></textarea>
                <?php } ?>
            <br>
            <br>
            <div class="row">
              <h5 class="col-8">Especialidades:</h5>
              <button type="button" class="col-4  btn btn-success " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                agregar nueva especialidad
              </button>
            <div>
            <div class="row">
            <?php
            $resultado = mysqli_query($bd, $usuarios1); 
            while($row=mysqli_fetch_assoc($resultado)) {
                $id_descripcion = $row['id_descripcion'];
                $tipo_abogado = "SELECT * FROM descripcion_tipo WHERE id_abogado =  $id_descripcion"; 
                $resultado1 = mysqli_query($bd, $tipo_abogado);
                  while($row1=mysqli_fetch_assoc($resultado1)) {
                      $especialidad = $row1['id_tipo'];
                      $tipo = "SELECT * FROM tipo_abogado WHERE id_tipo =  $especialidad"; 
                      $resultado2 = mysqli_query($bd, $tipo);
                      while($row2=mysqli_fetch_assoc($resultado2)) { ?>
                      <button style="margin-bottom: 6%; margin-left: 2%;"class="btn btn-primary col-3" type="submit"><?php echo $row2['tipo_abogado']; ?></button>
                  <?php    }}}
                        ?>
            <div>
        </div>
        
        <br>
        <br>
    </form>
    <?php
    if(isset($_REQUEST['actualizar_foto'])){
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $actualizar = "UPDATE descripcion_abogado SET  imagen='$imgContent' WHERE id_abogado='$id'";
        $validando = mysqli_query($bd, $actualizar);
        if ($validando){
            echo "<script>alert('se ha actualizado la foto');window.location='abogado_descripcion.php'</script>";
        }else{
            echo "<script>alert('No se ha actualizado la foto');window.location='abogado_descripcion.php'</script>";
        }
    }
    if (isset($_REQUEST['guardar'])) {
        $descripcion = $_POST['descripcion'];
        $actualizar = "UPDATE descripcion_abogado SET descripcion='$descripcion' WHERE id_abogado='$id'";
        $validando = mysqli_query($bd, $actualizar);
        if ($validando){
            echo "<script>alert('se ha actualizado los datos');window.location='abogado_descripcion.php'</script>";
        }else{
            echo "<script>alert('No se ha actualizado los datos');window.location='abogado_descripcion.php'</script>";
        }
    }
    ?>
<script src="../js/cerrarsesion.js"></script>
</body>
<?php include "agregar.php"; ?>
</html>