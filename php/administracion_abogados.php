<?php 
session_start();
include("session.php");
$usuarios = "SELECT * FROM usuarios";
$usuarios1 = "SELECT * FROM descripcion_abogado";
$usuarios2 = "SELECT * FROM descripcion_tipo";
$usuarios3 = "SELECT * FROM tipo_abogado";
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
    <div class="col-2 text-center" style="margin-top:8px;">
      <h3 class="fw-bolder">Abogados</h3>
    </div>
    <form class="col-10 text-end" method="get" style="margin-top:10px;">
        <input type="text" name="busqueda">
        <input class="btn btn-primary" type="submit" name="enviar" value="buscar">
    </form>
    <form class="col-8 col-sm-6 col-md-4 col-lg-5 col-xl-5 text-center" action="" method="get" style="margin-top:10px;">
          <select id="tipo_abogado" name="tipo_abogado">
              <?php
                  $mysqli = new mysqli('localhost', 'root', '', 'pqp');
                  ?>
                  <option value=" ">-- Seleccionar --</option>
                  <?php
                  $query = $mysqli->query("SELECT * FROM tipo_abogado order by tipo_abogado asc");
                      while ($valores = mysqli_fetch_array($query)) {
                          if($valores){
                              echo '<option value="' . $valores['id_abogado'] . '">' . $valores['tipo_abogado'] . '</option>';
                          }}?>
          </select>    
          <input class="boton" type="submit" name="aplicar" value="aplicar filtro">
    </form>
    <div class="row">
    <?php
        if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];
            $consulta = $bd->query("SELECT * FROM usuarios WHERE nombres LIKE '%$busqueda%' and rol_fk=2");
            while($row = $consulta->fetch_array()){?>
                        <br>
                        <div class="col-11 col-sm-5 col-md-5 col-lg-3 border border-4 text-center rounded-4 p-3 mb-2 bg-light shadow p-3 mb-5 bg-body-tertiary rounded" style="margin-left: 6%; margin-top: 2%;" >
                        <?php $resultado1 = mysqli_query($bd, $usuarios1);
                            while($row1=mysqli_fetch_assoc($resultado1)) {
                                if($row1['id_abogado']==$row["identificacion"]){?>
                                    <br>
                                    <img width="100" src="data:image/png;base64,<?php echo base64_encode($row1["imagen"]);?>" class="img-thumbnail">
                                    <br>
                                    <?php $resultado2 = mysqli_query($bd, $usuarios2);
                                      while($row2=mysqli_fetch_assoc($resultado2)) {
                                      if($row2['id_abogado']==$row1["id_descripcion"]){
                                        $resultado3 = mysqli_query($bd, $usuarios3);
                                        while($row3=mysqli_fetch_assoc($resultado3)) {
                                            if($row3['id_tipo']==$row2["id_tipo"]){
                                        ?>
                                      <p>Abogado <?php echo $row3["tipo_abogado"];?></p>
                              
                    <?php }}}}}}?>
                            <a href="administracion_perfil_abg.php?id1=<?php echo $row["identificacion"];?>" class="table__item"><?php echo $row["nombres"];?> <?php echo $row["apellidos"];?></a>
                            <p class="table__item"><?php echo $row["correo_electronico"];?></p>
                            <p class=""><?php echo $row["telefono"];?></p>
                        </div>
                        <br>
            <?php }
        }elseif(isset($_GET['aplicar'])) {
                    $filtro = $_GET['tipo_abogado'];
                    $consulta = $bd->query("SELECT * FROM descripcion_tipo WHERE id_tipo LIKE '%$filtro%'");
                    while($row = $consulta->fetch_array()){?>
                    <?php $abg = $row['id_abogado'];
                          $vali = "SELECT * FROM descripcion_abogado WHERE id_descripcion = $abg";
                          $obvi = mysqli_query($bd, $vali);
                            while($row5=mysqli_fetch_assoc($obvi)) {
                              $llama = $row5['id_abogado'];
                              $ida ="SELECT * FROM usuarios WHERE identificacion = $llama";
                              $obvi5 = mysqli_query($bd, $ida);
                              while($row6=mysqli_fetch_assoc($obvi5)) {?>
                        <div class="col-11 col-sm-5 col-md-5 col-lg-3 border border-4 text-center rounded-4 p-3 mb-2 bg-light shadow p-3 mb-5 bg-body-tertiary rounded" style="margin-left: 6%; margin-top: 2%;" >
                          <img width="100" height="100" src="data:image/png;base64,<?php echo base64_encode($row5["imagen"]);?>" class="img-thumbnail">
                          <br>
                          <a href="administracion_perfil_abg.php?id1=<?php echo $row6["identificacion"];?>" class="table__item"><?php echo $row6["nombres"];?> <?php echo $row6["apellidos"];?></a>
                          <p ><?php echo $row6["correo_electronico"];?></p>
                          <p><?php echo $row6["telefono"];?></p>
                        </div>     
                        <?php
                            } }}
        }else{
            $resultado = mysqli_query($bd, $usuarios);
            while($row=mysqli_fetch_assoc($resultado)) { 
                if ( $row['rol_fk']==2){?>
                    <br>
                    <div class="col-11 col-sm-5 col-md-5 col-lg-3 border border-4 text-center rounded-4 p-3 mb-2 bg-light shadow p-3 mb-5 bg-body-tertiary rounded" style="margin-left: 6%; margin-top: 2%;" >
                    <?php $resultado1 = mysqli_query($bd, $usuarios1);
                        while($row1=mysqli_fetch_assoc($resultado1)) {
                            if($row1['id_abogado']==$row["identificacion"]){?>
                                <br>
                                <img width="100" src="data:image/png;base64,<?php echo base64_encode($row1["imagen"]);?>" class="img-thumbnail">
                                <?php $resultado2 = mysqli_query($bd, $usuarios2);
                                      while($row2=mysqli_fetch_assoc($resultado2)) {
                                      if($row2['id_abogado']==$row1["id_descripcion"]){
                                        $resultado3 = mysqli_query($bd, $usuarios3);
                                        while($row3=mysqli_fetch_assoc($resultado3)) {
                                            if($row3['id_tipo']==$row2["id_tipo"]){
                                        ?>
                                      <p>Abogado <?php echo $row3["tipo_abogado"];?></p>
                              
                    <?php }}}}}}?>
                        <a href="operador_visualizarperfil.php?id1=<?php echo $row["identificacion"];?>" class="table__item"><?php echo $row["nombres"];?> <?php echo $row["apellidos"];?></a>
                        
                        <p class="table__item"><?php echo $row["correo_electronico"];?></p>
                        <p class=""><?php echo $row["telefono"];?></p>
                    </div>
                    <br>
            <?php } }}?>
    </div>
  </div>
      </div>
  </div>
</div>
</body>
</html>