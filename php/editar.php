<?php 
session_start();
$id1 = $_SESSION['id'];
$id = $_GET['id'];
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id'";
include("../conexion/cn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Administracion</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="administracion_inicio.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="formulario_registro.php">Registrar Usuario</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tablas de Usuarios
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="administracion_cliente.php">Clientes</a></li>
            <li><a class="dropdown-item" href="administracion_abogado.php">Abogados</a></li>
            <li><a class="dropdown-item" href="administracion_operador.php">Operadores</a></li>
            <li><a class="dropdown-item" href="administracion_administrador.php">Administradores</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href=../calendarioeventos/index.php">Calendario de eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="administracion_procesos.php">procesos</a>
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
                <li><a class="dropdown-item" href="administracion_perfil.php">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main>
        <div class="container shadow p-3 mb-5 bg-body-tertiary border border-3 rounded py-4 text-center p-3 mb-2 bg-light-subtle text-emphasis-light" style="margin-top: 3%;">
            <h2>actualizar</h2>
            <div class="row py-4">
                <div class="col">
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <th class="sort asc">identificacion</th>
                            <th class="sort asc">Nombres</th>
                            <th class="sort asc">Apellidos</th>
                            <th class="sort asc">telefono</th>
                            <th class="sort asc">Correo_electronico</th>
                            <th class="sort asc">Direccion</th>
                            <th class="sort asc">Contraseña</th>
                            <th class="sort asc">Actualizar<th>
                        </thead>
                    <?php $resultado = mysqli_query($bd, $usuarios);
                        while($row=mysqli_fetch_assoc($resultado)) { ?>
                        <tbody id="content">
                            <form method="POST">
                                    <tr>
                                        <th><input type="text" class="form-control"  value="<?php echo $row["identificacion"];?>" name="identificacion" disabled></th>
                                        <td><input type="text"  class="form-control" value="<?php echo $row["nombres"];?>"  name="nombres" ></td>
                                        <td><input type="text"  class="form-control" value="<?php echo $row["apellidos"];?>"  name="apellidos"></td>
                                        <td><input type="text"  class="form-control" value="<?php echo $row["telefono"];?>" name="telefono" ></td>
                                        <td><input type="text"  class="form-control" value="<?php echo $row["correo_electronico"];?>" name="correo_electronico" ></td>
                                        <td><input type="text"  class="form-control" value="<?php echo $row["direccion"];?>"  name="dirreccion" ></td>
                                        <td><input type="text"  class="form-control" value="<?php echo $row["contraseña"];?>" name="contraseña" ></td>
                                        <td><input type="submit" class="btn btn-primary" name="actualizar" value="actualizar"></a></td>
                                    </tr>
                            <?php }?>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            if(isset($_POST['actualizar'])){
                $nombres = $_POST["nombres"];
                $apellidos = $_POST["apellidos"];
                $correo_electronico = $_POST["correo_electronico"];
                $contraseña = $_POST["contraseña"];
                $telefono = $_POST["telefono"];
                $dirreccion = $_POST["dirreccion"];

                $actualizar = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', correo_electronico='$correo_electronico',  contraseña='$contraseña', direccion='$dirreccion', telefono='$telefono' WHERE identificacion='$id'";
                $validando = mysqli_query($bd, $actualizar);
                if($validando){
                    echo "<script>alert('se ha actualizado los datos');window.location='administracion_inicio.php'</script>";
                }else{
                    echo "<script>alert('No logro modificar los datos');window.location='administracion_inicio.php'</script>";
                }
            }?>
        </div>
    </main>
</body>
</html>