<?php 
session_start();
include("session.php");
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id'";
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
        <a class="nav-link active" aria-current="page" href="administracion_inicio.php">Graficos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="administracion_dempresa.php">Datos de la Empresa</a>
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
      <a class="nav-link active" aria-current="page" href="administracion_inicio.php">Graficos</a>
      <a class="nav-link" href="administracion_dempresa.php">Datos de la empresa</a>
      <a class="nav-link" href="administracion_tipo_abogado.php">Tipos de Abogados</a>
      <a class="nav-link" href="administracion_abogados.php">Abogados</a>
    </nav>
  </div>
  <div class=" col-md-12 col-lg-9 p-3 mb-2 bg-light text-dark border border-4">
    <div class="row">
      <div class="pie col-12 col-md-6 d-flex justify-content-center">
        <h6 style="margin-left: 5%;">Grafico de usuarios</h6>
        <canvas id="grafico"></canvas>
      </div>
      <div class="pie col-12 col-md-6 d-flex justify-content-center">
      <h6 style="margin-left: 5%;">Grafico de Casos</h6>
        <canvas id="grafico_pie" ></canvas>
      </div>
      <?php
                      $consulta = "SELECT * FROM caso";
                      $i1 = 0;
                      $proceso = 0;
                      $finalizado = 0;
                      $resultado = mysqli_query($bd, $consulta);
                      while($row=mysqli_fetch_assoc($resultado)) {
                          $i1 = $i1+1;
                          if($row['estado_fk']==1){
                              $proceso = $proceso+1;
                          }elseif($row['estado_fk']==2){
                              $finalizado = $finalizado+1;
                          }
                      }
                      // Datos para el gráfico
                      $labels = ["Casos en Proceso", "Casos Finalizados"];
                      $data = [ $proceso,$finalizado];
                      $colores = ["#FF6384", "#36A2EB"];
                      ?>

                  <script>
                      // Obtener el contexto del lienzo (canvas)
                      var ctx = document.getElementById("grafico_pie").getContext("2d");

                      // Crear el gráfico de tipo pie
                      var myChart = new Chart(ctx, {
                          type: 'pie',
                      data: {
                              labels: <?php echo json_encode($labels); ?>,
                              datasets: [{
                                  data: <?php echo json_encode($data); ?>,
                                  backgroundColor: <?php echo json_encode($colores); ?>
                                  }]
                              }
                          });
                  </script>
      <?php
                      $consulta = "SELECT * FROM usuarios";
                      $i = 0;
                      $c_cliente = 0;
                      $c_abogado = 0;
                      $c_operador = 0;
                      $c_administrador = 0;
                      $resultado = mysqli_query($bd, $consulta);
                      while($row=mysqli_fetch_assoc($resultado)) {
                          $i = $i+1;
                          if($row['rol_fk']==1){
                              $c_administrador = $c_administrador+1;
                          }elseif($row['rol_fk']==2){
                              $c_abogado = $c_abogado+1;
                          }elseif($row['rol_fk']==3){
                              $c_operador = $c_operador+1;
                          }elseif($row['rol_fk']==4){
                              $c_cliente = $c_cliente+1;
                          }
                      }
                      // Datos para el gráfico
                      $labels = ["Administradores", "Abogados", "Operadores","Clientes"];
                      $data = [ $c_administrador,$c_abogado, $c_operador, $c_cliente];
                      $colores = ["#FF5555", "#55FFFF", "#55FF55 ", " #FFFF55"];
                      ?>

                  <script>
                      // Obtener el contexto del lienzo (canvas)
                      var ctx = document.getElementById("grafico").getContext("2d");

                      // Crear el gráfico de tipo pie
                      var myChart = new Chart(ctx, {
                          type: 'pie',
                      data: {
                              labels: <?php echo json_encode($labels); ?>,
                              datasets: [{
                                  data: <?php echo json_encode($data); ?>,
                                  backgroundColor: <?php echo json_encode($colores); ?>
                                  }]
                              }
                          });
                  </script>
      <div class="row justify-content-around" style="margin: 3%;">
        <div class="col-12 col-md-5 rounded" style="margin-bottom: 1%; background: #A7A9CE ; ">
          <p class="fw-bolder border-bottom">Total Usuarios:</p>
          <h3 class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
          </svg> <?php echo $i ?></h3>
        </div>
        <div class="col-12 col-md-5 rounded" style="margin-bottom: 1%; background: #A7A9CE ; ">
          <p class="fw-bolder border-bottom">Total Casos:</p>
          <h3 class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
          </svg> <?php echo $i1?></h3>
        </div>
      </div>
  </div>
</div>
</body>
</html>