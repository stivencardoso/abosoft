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
<div class="p-3 mb-2 bg-white text-dark rounded border border-4 shadow-lg p-3 mb-5 bg-body-tertiary" style="margin: 4%;">
    <div class="col-12 text-center"  style="margin: 2%;">
        <h4>Mis casos</h4>
    </div>
    <div class="row" style="margin: 1%; margin-bottom: 4%;">
    <form class="col-12 text-end" method="get" style=" margin-bottom: 1%;">
            <input type="text" name="busqueda">
            <input class="btn btn-primary" type="submit" name="enviar" value="buscar">
        </form>
 <?php
        if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];
            $consulta = $bd->query("SELECT * FROM caso WHERE nombre_caso LIKE '%$busqueda%' and estado_fk=1");
            while($row = $consulta->fetch_array()){?>
                     <div class="card " style="width: 18rem; margin-right: 1%; margin-bottom: 1%;">
                        <div class="card-body">
                        <h5 class="card-title"><?php echo $row['nombre_caso'] ;?></h5>
                        <p class="card-text">Da click en ver caso para ver su informacion</p>
                        <a href="cliente_proceso_informacion.php?id_caso=<?php echo $row['id_caso']; ?>" class="btn btn-primary">Ver caso</a>
                        </div>
                    </div>
         <?php }} else {?>
        <div class="row d-flex justify-content-center">
      <?php
        $taylor = "SELECT * FROM caso WHERE estado_fk = 1";
        $missyou = mysqli_query($bd, $taylor);
        while($row1=mysqli_fetch_assoc($missyou)) {?>
          <div class="card " style="width: 18rem; margin-right: 1%; margin-bottom: 1%;">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row1['nombre_caso'] ;?></h5>
              <p class="card-text">Da click en ver caso para ver su informacion</p>
              <a href="cliente_proceso_informacion.php?id_caso=<?php echo $row1['id_caso']; ?>" class="btn btn-primary">Ver caso</a>
            </div>
          </div>
        <?php  } }?>
        </div>
    </div>
        </div>
    </div>
</div>
</body>
</html>