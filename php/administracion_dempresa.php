<?php 
session_start();
include("session.php");
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id'";
$empresa_1 = "SELECT * FROM empresa WHERE nit_empresa = '8001972684'";
$empresa_2 = "SELECT * FROM informacion_empresa WHERE id_empresa = '8001972684'";
include("../conexion/cn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/final.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-black">
  <div class="container-fluid text-white">
    <a class="navbar-brand text-white" href="#">Administracion</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="administracion_inicio.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="formulario_registro.php">Registrar Usuario</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tablas de Usuarios
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item " href="administracion_cliente.php">Clientes</a></li>
            <li><a class="dropdown-item " href="administracion_abogado.php">Abogados</a></li>
            <li><a class="dropdown-item " href="administracion_operador.php">Operadores</a></li>
            <li><a class="dropdown-item " href="administracion_administrador.php">Administradores</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="../calendarioeventos/index.php">Calendario de eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="administracion_procesos.php">procesos</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0 text-end" style="margin-right: 4%;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg> Usuario
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="administracion_perfil.php">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="row justify-content-between " style="margin: 1%;">
  <div class="d-lg-none p-3 mb-2 bg-light text-dark border border-4">
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="administracion_inicio.php ">Graficos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="administracion_dempresa.php">Datos de la Empresa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="administracion_tipo_abogado.php">tipos de abogados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="administracion_abogados.php">abogados</a>
      </li>
    </ul>
  </div>
  <div class="col-12 col-md-2 p-3 mb-2 bg-light text-dark border border-4 d-none d-lg-block">
    <nav class="nav flex-column">
      <a class="nav-link" aria-current="page" href="administracion_inicio.php">Graficos</a>
      <a class="nav-link active" href="administracion_dempresa.php">Datos de la empresa</a>
      <a class="nav-link" href="administracion_tipo_abogado.php">Tipos de Abogados</a>
      <a class="nav-link" href="administracion_abogados.php">Abogados</a>
    </nav>
  </div>
  <div class=" col-md-12 col-lg-9 p-3 mb-2 bg-light text-dark border border-4">
    <div class="row">
    <?php 
            $empresa = "SELECT * FROM empresa";
            $resultado = mysqli_query($bd, $empresa);
                    while($row1=mysqli_fetch_assoc($resultado)){ ?>
                    <?php if(isset($_GET['modificar_datos'])){ ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h6 class="fw-semibold">Nombre de la Empresa: </h6>
                                    <input style="margin-left: 8%; width: 90%" class="form-control" type="text" value="<?php echo $row1["nombre_empresa"];?>" name="nombre_empresa" disabled>
                                    <br>
                                    <h6 class="fw-semibold">Direccion: </h6>
                                    <input style="margin-left: 8%; width: 90%" class="form-control" type="text" value="<?php echo $row1["direccion"];?>" name="dirrecion">
                                    <br>
                                    <h6 class="fw-semibold">Telefono: </h6>
                                    <input style="margin-left: 8%; width: 90%" class="form-control" type="text" value="<?php echo $row1["telefono"];?>" name="telefono">
                                </div>
                                <?php 
                                  $resultado1 = mysqli_query($bd, $empresa_2); 
                                  while($row4=mysqli_fetch_assoc($resultado1)) {
                                ?>
                                <div class="col-12 col-md-6">
                                    <h6 class="fw-semibold">Logo: </h6>
                                    <input  class="form-control" type="file" name="logo">
                                    <img style="margin-left: 8%; margin-top: 2%" width="80%" src="data:image/png;base64,<?php echo base64_encode($row4["logo"]);?> ">
                                    <button class="btn btn-success" style="margin-left: 30%; margin-top: 5%" type="submit" class="joinBtn" name="actualizar_logo"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                                    </svg> Actualizar Logo</button>
                                </div>
                                <div class="row justify-content-sm-center justify-content-md-around" style="margin-left: 0%;">
                                    <div class=" border border-secondary col-12 col-md-5 p-3 mb-2 bg-light-subtle text-emphasis-ligh shadow p-3 mb-5 bg-body-tertiary rounded" style="margin-top: 3%; text-align: justify;">
                                        <h6 class="fw-semibold">MISION DE LA EMPRESA</h6>
                                        <textarea class="col-12 form-control" style="text-align: justify; width: 100%; height: 250px;" name="mision"><?php echo $row4["mision"]; ?></textarea>
                                    </div>
                                    <div class="border border-secondary col-12 col-md-5 p-3 mb-2 bg-light-subtle text-emphasis-ligh shadow p-3 mb-5 bg-body-tertiary rounded" style="margin-top: 3%; text-align: justify;">
                                        <h6 class="fw-semibold">VISION DE LA EMPRESA</h6>
                                        <textarea class="col-12 form-control" style="text-align: justify; width: 100%; height: 250px;" name="vision"><?php echo $row4["vision"]; }?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <a class="btn btn-primary" href="http://127.0.0.1/proyectofinal/php/Datos_empresa.php" role="button">Volver</a>
                                <input class="btn btn-success" type="submit" class="submitBtn" value="modicar" name="Modificar">
                            </div>
                        </form>
                        <?php 
                        if(isset($_REQUEST['actualizar_logo'])){
                            $check = getimagesize($_FILES["logo"]["tmp_name"]);
                            $image = $_FILES['logo']['tmp_name'];
                            $imgContent = addslashes(file_get_contents($image));
                            $actualizar = "UPDATE informacion_empresa SET  logo='$imgContent' WHERE id_info='1'";
                            $validando1 = mysqli_query($bd, $actualizar);
                            if ($validando1){
                                echo "<script>alert('se ha actualizado el logo');window.location='administracion_dempresa.php'</script>";
                            }else{
                                echo "<script>alert('No se ha actualizado el logo');window.location='administracion_dempresa.php'</script>";
                            }
                        }
                        if (isset($_REQUEST['Modificar'])) {
                            $dirrecion = $_POST['dirrecion'];
                            $telefono = $_POST['telefono'];
                            $vision = $_POST['vision'];
                            $mision = $_POST['mision'];

                            $finalizar = "UPDATE empresa SET telefono='$telefono', direccion='$dirrecion' WHERE nit_empresa = '8001972684'";
                            $validando = mysqli_query($bd, $finalizar);
                            $finalizar_1 = "UPDATE informacion_empresa SET vision='$vision', mision='$mision' WHERE id_empresa = '8001972684'";
                            $validando_1 = mysqli_query($bd, $finalizar_1);
                            if($validando){
                                echo "<script>alert('se han modificado con exito los datos');window.location='administracion_dempresa.php'</script>";
                            }else{
                                echo "<script>alert('No se pudo realizar los cambios');window.location='administracion_dempresa.php'</script>";
                            }
                        }

                            ?>
                    <?php }else{ ?>
    <?php $resultado2 = mysqli_query($bd, $empresa_1); 
        while($row2=mysqli_fetch_assoc($resultado2)) { ?>
      <h3><?php echo $row2["nombre_empresa"];?></h3>
      <form class="col-12 text-end" method="get">
        <input class="btn btn-secondary" type="submit" name="modificar_datos" value="Modificar Datos">
      </form>
      <div class="row">
        <div class="col-12 col-sm-6">
            <h6 class="fw-semibold">Nombre de la Empresa: </h6>
            <p style="margin-left: 8%;"><?php echo $row2["nombre_empresa"]; ?><p>
            <h6 class="fw-semibold">Direccion: </h6>
            <p style="margin-left: 8%;"><?php echo $row2["direccion"]; ?><p>
            <h6 class="fw-semibold">Telefono: </h6>
            <p style="margin-left: 8%;"><?php echo $row2["telefono"];} ?><p>
        </div>
        <?php $resultado3 = mysqli_query($bd, $empresa_2); 
        while($row3=mysqli_fetch_assoc($resultado3)) { ?>
        <div class="col-12 col-md-6">
            <h6 class="fw-semibold">Logo: </h6>
            <img style="margin-left: 8%;" width="300" src="data:image/png;base64,<?php echo base64_encode($row3["logo"]);?> ">
        </div>
        <div class="row justify-content-sm-center justify-content-md-around" style="margin-left: 2%;">
            <div class=" border border-secondary col-12 col-lg-5 p-3 mb-2 bg-light-subtle text-emphasis-ligh shadow p-3 mb-5 bg-body-tertiary rounded" style="margin-top: 3%; text-align: justify;">
                <h6 class="fw-semibold">MISION DE LA EMPRESA</h6>
                <p><?php echo $row3["mision"]; ?><p>
            </div>
            <div class="border border-secondary col-12 col-lg-5 p-3 mb-2 bg-light-subtle text-emphasis-ligh shadow p-3 mb-5 bg-body-tertiary rounded" style="margin-top: 3%; text-align: justify;">
                <h6 class="fw-semibold">VISION DE LA EMPRESA</h6>
                <p ><?php echo $row3["vision"]; }?><p>
            </div>
        </div>
       </div>
       <?php }} ?>
    </div>
  </div>
</div>
</body>
</html>