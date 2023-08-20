<?php
include("../conexion/cn.php");


// Obtener el nombre del archivo desde la URL
$id = $_GET['id'];

// Buscar el archivo en la base de datos
$sql = "DELETE FROM usuarios WHERE identificacion = '$id'";
$resultado=mysqli_query($bd, $sql);
if($resultado){
    echo "<script>alert('se ha eliminado el usuario');window.location='administracion_inicio.php'</script>";
}else{
    echo "<script>alert('error al eliminar el usuario');window.history.go(-1);'</script>";
}
?>