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
        <a class="nav-link" aria-current="page" href="administracion_inicio.php">Graficos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="administracion_dempresa.php">Datos de la Empresa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="administracion_tipo_abogado.php">tipos de abogados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="administracion_abogados.php">abogados</a>
      </li>
    </ul>
  </div>
  <div class="col-12 col-md-2 p-3 mb-2 bg-light text-dark border border-4 d-none d-lg-block">
    <nav class="nav flex-column">
      <a class="nav-link" aria-current="page" href="administracion_inicio.php">Graficos</a>
      <a class="nav-link" href="administracion_dempresa.php">Datos de la empresa</a>
      <a class="nav-link  active" href="administracion_tipo_abogado.php">Tipos de Abogados</a>
      <a class="nav-link" href="administracion_abogados.php">Abogados</a>
    </nav>
  </div>
  <div class=" col-md-12 col-lg-9 p-3 mb-2 bg-light text-dark border border-4">
    <div class="row d-flex justify-content-between">
        <h3 class="col-8">Especialidades abogados</h3>
        <div  class="col-4 ">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Agregar Especialidad
            </button>       
        </div>
                <table class="table table-bordered" style="margin-top: 2%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <?php $i = 0;
                            $tipo_abogado = "SELECT * FROM tipo_abogado"; 
                            $resultado = mysqli_query($bd, $tipo_abogado);
                            while($row=mysqli_fetch_assoc($resultado)) {
                                $i++;
                        ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['tipo_abogado'] ?></td>
                            <td><a class="btn btn-danger" href="eliminar_tipo_abogado.php?id=<?php echo $row['id_tipo'] ?>" role="button">Eliminar</a></td>
                        </tr>
                    </tbody>
                    <?php  }
            ?>
                </table>
    </div>
  </div>
</div>
</body>
<?php include "agregar1.php"; ?>
</html>