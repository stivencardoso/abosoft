<?php
include("../conexion/cn.php");
$nombre = $_POST['nombre'];

$validar ="SELECT * FROM tipo_abogado WHERE tipo_abogado='$nombre'";
$validando = mysqli_query($bd, $validar);
$filas=mysqli_num_rows($validando);

if($filas>0 ){
    echo "<script>alert('ya esta agregarda esta especialidad');window.history.go(-1);</script>";
}else{
    $insertar_usuario = "INSERT INTO tipo_abogado (tipo_abogado) VALUES
    ('$nombre')";
    $resultado_usuario = mysqli_query($bd, $insertar_usuario);
    echo "<script>alert('se ha agregado una nueva especialidad');window.location='administracion_tipo_abogado.php'</script>";
}