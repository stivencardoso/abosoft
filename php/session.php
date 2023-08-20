<?php
if($id = $_SESSION['id'] == 0){
    $id = 0;
  echo "<script>alert('por favor iniciar sesion para poder acceder a la plataforma');;window.location='iniciosesion.php'</script>";
}else{
    $id = $_SESSION['id'];
}