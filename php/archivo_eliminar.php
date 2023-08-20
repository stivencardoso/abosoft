<?php
include "../conexion/cn.php";


// Obtener el nombre del archivo desde la URL
$id = $_GET['id'];

// Buscar el archivo en la base de datos
$sql = "DELETE FROM documento WHERE id = '$id'";
$resultado=mysqli_query($bd, $sql);
if($resultado){
    echo "<script>alert('se ha eliminado el archivo');window.location='http://127.0.0.1/proyectofinal/php/repositorio.php'</script>";
}else{
    echo "<script>alert('error al eliminar el archivo');window.location='http://127.0.0.1/proyectofinal/php/repositorio.php'</script>";
}
?>