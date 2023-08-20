<?php 
include("../conexion/cn.php");
$empresa_1 = "SELECT * FROM empresa ";
$empresa= "SELECT * FROM informacion_empresa ";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .ov-btn-slide-left {
    background:#5555FF; /* color de fondo */
    color: #ffffff; /* color de fuente */
    border: 2px solid #4741d7; /* tamaño y color de borde */
    padding: 16px 20px;
    border-radius: 3px; /* redondear bordes */
    position: relative;
    z-index: 1;
    overflow: hidden;
    display: inline-block;
  }
  .ov-btn-slide-left:hover {
    color: #fff; /* color de fuente hover */
  }
  .ov-btn-slide-left::after {
    content: "";
    background: #332ddf; /* color de fondo hover */
    position: absolute;
    z-index: -1;
    padding: 16px 20px;
    display: block;
    top: 0;
    bottom: 0;
    left: -100%;
    right: 100%;
    -webkit-transition: all 0.35s;
    transition: all 0.35s;
  }
  .ov-btn-slide-left:hover::after {
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    -webkit-transition: all 0.35s;
    transition: all 0.35s;
  }
  .logo {
    border-radius: 50%;
    width: 150px;
  }
  
  .logo:hover {
    box-shadow: 0 0 10px rgba(0,0,0,.2);
    width: 200px;
  }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css/final.css">
</head>
<body>
<div class="row border-bottom" style="margin:2%;">
    <h5 class="col-2 col-md-1 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
      <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
    </svg> PQP</h5>
    <a class="text-white  col-6 col-md-9 link-offset-2 link-underline link-underline-opacity-0" href="inicio.php" role="button">INICIO</a>
    <a class=" bg-success text-white btn btn-primary col-4 col-md-2" href="iniciosesion.php" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg> Inicio Sesion</a>
</div>
  <div class=" d-flex justify-content-center" style="margin-top: 2%;">
    <form action="../php/usuario_validar.php" class="col-10 col-sm-6 col-lg-4 border border-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded" method="POST">
      <?php 
      $resultado1 = mysqli_query($bd, $empresa); 
      while($row=mysqli_fetch_assoc($resultado1)) {
      ?>
      <div class="d-flex justify-content-center">
        <img height="210px" src="data:image/png;base64,<?php echo base64_encode($row["logo"]);}?>" class="rounded-circle flipSide-360">
      </div>
      <div class="d-flex justify-content-center border-bottom border-bottom">
        <h3 style="color: #000080;">Inicio de Sesion</h3>
      </div>
      <br>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="floatingInput"  placeholder="Username" name="identificacion" required>
        <label for="floatingInput"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
          <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z"/>
          <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z"/>
        </svg> Identificacion</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="contraseña" required>
        <label for="floatingPassword"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
          <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
          <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
        </svg> Contraseña</label>
      </div>
      <br>
      <div class="text-end" style="margin-bottom: 3%;">
        <button type="submit" name="entrar" class=" col-12 ov-btn-slide-left">Entrar</button>
      </div>
    </form>
  </div>
  <footer class="p-3 mb-2 bg-white text-dark">
    <div class="row" style="margin-left:5%; margin-right: 5%; margin-top: 2%">
      <div class="col-12 col-md-3">
      <?php $resultado3 = mysqli_query($bd, $empresa_1);
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
    <?php $resultado3 = mysqli_query($bd, $empresa_1);
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
</body>
</html>