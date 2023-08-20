<?php 
session_start();
include("session.php");
$id1 = $_GET['id1'];
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id1'";
$usuarios1 = "SELECT * FROM descripcion_abogado WHERE id_abogado = '$id1'";
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
<div class="row perfil border border-3 rounded p-3 mb-2 bg-body text-body" style="margin: 2%;">
        <div class="col-4">
            <h2><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg>
            Perfil de Abogado</h2>
        </div>
        <div class="col-8 text-end">
            <a class="btn btn-primary" href="operador_buscador_abogados.php" role="button">Volver</a>
        </div>
        <br>
        <br>
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 text-center" style="margin-top: 1%; margin-bottom: 3%;">
            <?php $resultado1 = mysqli_query($bd, $usuarios1); 
                while($row=mysqli_fetch_assoc($resultado1)) {?>   
                    <img width="300" src="data:image/png;base64,<?php echo base64_encode($row["imagen"]);}?> ">
        </div>
        <br>
        <div class="col-12 col-sm-12 col-md-12 col-lg-7 " style="text-align: justify;">
            <?php $resultado = mysqli_query($bd, $usuarios); 
                while($row=mysqli_fetch_assoc($resultado)) { ?>
                    <h3>Abogado/a: <em><?php echo $row["nombres"];?> <?php echo $row["apellidos"];}?></em></h3>
            <?php $resultado1 = mysqli_query($bd, $usuarios1); 
                while($row=mysqli_fetch_assoc($resultado1)) {
                    echo $row["descripcion"];}
            ?>
            <br>
            <br>
            <h5>Especialidades:</h5>
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
                      <button style="margin-bottom: 2%; margin-left: 2%;"class="btn btn-primary col-3" type="submit"><?php echo $row2['tipo_abogado']; ?></button>
                  <?php    }}}
                        ?>
            <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
                <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2H2Zm-2 9.8V4.698l5.803 3.546L0 11.801Zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586l-1.239-.757ZM16 9.671V4.697l-5.803 3.546.338.208A4.482 4.482 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671Z"/>
                <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034v.21Zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791Z"/>
            <?php $resultado = mysqli_query($bd, $usuarios); 
                while($row=mysqli_fetch_assoc($resultado)) { ?>  
                    </svg> Correo Electronico: <?php echo $row["correo_electronico"];}?><p></p>
            <br>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
             <?php $resultado = mysqli_query($bd, $usuarios); 
                while($row=mysqli_fetch_assoc($resultado)) { ?>  
                    </svg> Telefono: <?php echo $row["telefono"];}?><p></p>
                </div>
            <br>
    </div>
<script src="../js/cerrarsesion.js"></script>
</body>
</html>