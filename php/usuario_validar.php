<?php
session_start();
$_SESSION['id'] = $_POST['identificacion'];
include("../conexion/cn.php");

$identificacion=$_POST['identificacion'];
$contraseña=$_POST['contraseña'];

$consulta="SELECT * FROM usuarios WHERE identificacion ='$identificacion' and contraseña='$contraseña'" ;
$resultado=mysqli_query($bd, $consulta);

$filas=mysqli_fetch_array($resultado);

if($filas['rol_fk']==1){
    header("location:administracion_inicio.php");
}elseif($filas['rol_fk']==2){
    header("location:abogado_procesos.php");
}elseif($filas['rol_fk']==3){
    header("location:operador_inicio.php");
}elseif($filas['rol_fk']==4){
    header("location:cliente_inicio.php");
}else{
    echo "<script>alert('Por favor revisa denuevo el Usuario y la Contraseña');window.history.go(-1);</script>";
}

mysqli_free_result($resultado);
mysqli_close($bd);
?>