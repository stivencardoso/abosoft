<?php
session_start();
$holi = $_SESSION['caso'];
include("../conexion/cn.php");
$finalizar = "UPDATE caso SET estado_fk='3' WHERE id_caso='$holi'";
$validando = mysqli_query($bd, $finalizar);
if($validando){
    echo "<script>alert('el caso ha finalizado');window.location='abogado_procesos.php'</script>";
}else{
    echo "<script>alert('fallado al finalizar el caso');window.location='abogado_procesos.php'</script>";    
}