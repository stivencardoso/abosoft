<?php 
include("../conexion/cn.php");
session_start();
include("session.php");
$cliente = $_GET['id1'];
$_SESSION['cliente'] = $_GET['id1'];
$cliente1 = "SELECT * FROM usuarios WHERE identificacion = $cliente";
$empresa = "SELECT * FROM informacion_empresa WHERE id_info = '1'";
$empresa_1 = "SELECT * FROM empresa WHERE nit_empresa = '8001972684'";

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
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Abogado</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../calendarioeventos/index.php">calendario de eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="abogado_formulario.php">Registrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="abogado_clientes.php">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="abogado_procesos.php">Procesos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="abogado_descripcion.php">Perfil Abogado</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 4%;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <img style="margin-top: 25%;" height="250px" src="data:image/png;base64,<?php echo base64_encode($row["logo"]);}?>" class="rounded-circle flipSide-360">
        <?php 
        $resultado2 = mysqli_query($bd, $empresa_1); 
        while($row2=mysqli_fetch_assoc($resultado2)) {
        ?>
        <h3 style="margin-top:2%;"><?php echo $row2["nombre_empresa"];}?></h3>
      </div>
      <form action="abogado_formulario_accioncaso.php?cliente='<?php $cliente ?>'" class="col-11 col-sm-9 col-md-6 p-3 mb-2 bg-light-subtle text-emphasis-light rounded" method="POST">
        <div class="row" style="margin: 1%;">
            <h3 class="border-bottom">Formulario para crear caso</h3>
            <?php 
            $ver = mysqli_query($bd, $cliente1); 
            while($row=mysqli_fetch_assoc($ver)) {
            ?>
            <h6>Cliente: <?php echo $row['nombres']; ?> <?php echo $row['apellidos'];} ?></h6>
            <input style="margin-left: 2%;" type="text" class="form-control" value="<?php echo $cliente ?>" name="cliente" disabled>
            <div class="inputContainer col-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                    <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <br>
                <input class="form-control" style="width: 50%;" type="text" class="input" placeholder="nombre del caso" id="nombres" name="nombres" required>
            </div>
            <br>
            <div class="inputContainer col-12">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <br>
                <textarea class="form-control" style="width: 100%; height: 50%;" type="text" class="input" placeholder="descripcion" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="text-end" style="margin-top: 3%;">
                <a class="btn btn-secondary" href="abogado_clientes.php" role="button">Volver</a>
                <button type="submit" class="btn btn-success">Registrar</button>
            </div>
        </div>
      </form>
    </div>
</body>