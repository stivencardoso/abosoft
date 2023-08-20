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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/final.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-black">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Operador</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="operador_inicio.php">inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="operador_buscador_abogados.php">buscador abogados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="../calendarioeventos/index.php">Caledario de eventos</a>
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
                <li><a class="dropdown-item" href="operador_perfil.php">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item salir" href="cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="row perfil border border-3 rounded p-3 mb-2  bg-secondary-subtle text-emphasis-secondary" style="margin: 4%;">
    <div class="col-2 text-center" style="margin-top:8px;">
      <h3 class="fw-bolder">Abogados</h3>
    </div>
    <form class="col-10 text-end" method="get" style="margin-top:10px;">
        <input type="text" name="busqueda">
        <input class="btn btn-primary" type="submit" name="enviar" value="buscar">
    </form>
    <form class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-3 text-center" action="" method="get" style="margin-top:10px;">
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
                            <a href="operador_visualizarperfil.php?id1=<?php echo $row["identificacion"];?>" class="table__item"><?php echo $row["nombres"];?> <?php echo $row["apellidos"];?></a>
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
                          <a href="operador_visualizarperfil.php?id1=<?php echo $row6["identificacion"];?>" class="table__item"><?php echo $row6["nombres"];?> <?php echo $row6["apellidos"];?></a>
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
  <footer class="p-3 mb-2 bg-white text-dark" style="margin-top: 3%;">
    <div class="row" style="margin-left:5%; margin-right: 5%;">
      <div class="col-12 col-md-3">
      <?php $empresa = "SELECT * FROM empresa ";
$empresa_info = "SELECT * FROM informacion_empresa ";
       $resultado3 = mysqli_query($bd, $empresa);
        while($row=mysqli_fetch_assoc($resultado3)) { ?>
          <h5 class="border-bottom"><?php echo $row['nombre_empresa'];}?></h5>
          <p>Con honor, integridad y decision, somos tu mejor defensa</p>
      </div>
      <div class="col-12 col-md-6">
          <h5 class="border-bottom">Mas Informacion de la Compañia</h5>
          <p style="text-align: justify;">nosotros somos un compañía de abogados que ofrece servicios legales a empresas y individuos
             en varios campos legales, como la inmigración, la ley laboral y la ley civil, nos se caracterizamos por ofrecer servicios profesionales y confiables a sus clientes, con un enfoque personalizado en cada caso.</p>
      </div>
      <div class="col-12 col-md-3">
          <h5 class="border-bottom">Informacion de Contacto</h5>
    <?php $resultado3 = mysqli_query($bd, $empresa);
        while($row=mysqli_fetch_assoc($resultado3)) { ?>
          <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
            <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
          </svg> <?php echo $row['correo_electronico'];?></p>
          <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
          </svg> <?php echo $row['telefono'];?></p>
          <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
          </svg> <?php echo $row['direccion'];?></p>
          <?php } ?>
      </div>
    </div>
</footer>
    <script src="../js/cerrarsesion.js"></script>
</body>
</html>