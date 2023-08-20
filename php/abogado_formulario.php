<?php 
session_start();
include("../conexion/cn.php");
$empresa = "SELECT * FROM informacion_empresa WHERE id_info = '1'";
$empresa_1 = "SELECT * FROM empresa WHERE nit_empresa = '8001972684'";
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de registro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    <div class="row d-flex justify-content-center" style="margin-top: 2%; margin-bottom: 7%;">
    <?php 
      $resultado1 = mysqli_query($bd, $empresa); 
      while($row=mysqli_fetch_assoc($resultado1)) {
      ?>
      <div class="col-4 text-center rounded bg d-none d-md-block border-end d-flex justify-content-center p-3 mb-2 bg-light-subtle text-emphasis-light">
        <img style="margin-top: 12%;" height="250px" src="data:image/png;base64,<?php echo base64_encode($row["logo"]);}?>" class="rounded-circle flipSide-360">
        <?php 
        $resultado2 = mysqli_query($bd, $empresa_1); 
        while($row2=mysqli_fetch_assoc($resultado2)) {
        ?>
        <h3 style="margin-top:2%;"><?php echo $row2["nombre_empresa"];}?></h3>
      </div>
      <form action="abogado_formulario_accion.php" class="col-11 col-sm-9 col-md-6 p-3 mb-2 bg-light-subtle text-emphasis-light rounded" method="POST">
        <div class="row" style="margin: 1%;">
            <h4 class="col-12 text-center" style="margin-bottom: 3%;" >Formulario de Registro</h4>
            <div class="col-6">
              <label for="inputAddress" class="form-label">Nombres</label>
              <input type="text" class="form-control" id="inputAddress" name="nombres">
            </div>
            <div class="col-6">
              <label for="inputAddress2" class="form-label">Apellidos</label>
              <input type="text" class="form-control" id="inputAddress2" name="apellidos">
            </div>
            <div class="col-6">
              <label for="inputAddress" class="form-label">Identificacion</label>
              <input type="number" class="form-control" id="inputAddress" name="identificacion">
            </div>
            <div class="col-6">
              <label for="inputAddress2" class="form-label">Telefono</label>
              <input type="number" class="form-control" id="inputAddress2" name="telefono">
            </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Direccion</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Barrio/casa/manzana/sector" name="direccion">
            </div>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Email</label>
              <input type="email" class="form-control" id="inputEmail4" name="correo_electronico">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="inputPassword4" name="contraseña">
            </div>
            <div class="text-end" style="margin-top: 3%;">
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
        </div>
      </form>
    </div>
</body>