<?php
include("../conexion/cn.php");


// Obtener el nombre del archivo desde la URL
$id = $_GET['id'];

// Buscar el archivo en la base de datos
$sql = "DELETE FROM tipo_abogado WHERE id_tipo = '$id'";
$resultado=mysqli_query($bd, $sql);
if($resultado){
    echo "<script>alert('ha eliminado este tipo de abogado');window.location='administracion_tipo_abogado.php'</script>";
}else{
    echo "<script>alert('no se elimino este tipo de abogado');window.history.go(-1);'</script>";
}
?>