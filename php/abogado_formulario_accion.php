<?php
include("../conexion/cn.php");
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$identificacion = $_POST['identificacion'] ;
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo_electronico = $_POST['correo_electronico'];
$contraseña = $_POST['contraseña'];

$validar ="SELECT * FROM usuarios WHERE identificacion='$identificacion'";
$validando = mysqli_query($bd, $validar);
$filas=mysqli_num_rows($validando);

if($filas>0 ){
    echo "<script>alert('ya hay un usuario registrado con la misma identificacion');window.history.go(-1);</script>";
}else{
    $insertar_usuario = "INSERT INTO usuarios (identificacion, nombres, apellidos, correo_electronico, telefono, direccion, contraseña, estado_usuario, rol_fk) VALUES
    ('$identificacion','$nombres', '$apellidos', '$correo_electronico', '$telefono', '$direccion', '$contraseña', '1', '4')";
    $resultado_usuario = mysqli_query($bd, $insertar_usuario);
}