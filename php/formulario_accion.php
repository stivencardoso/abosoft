<?php
include("../conexion/cn.php");
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$identificacion = $_POST['identificacion'] ;
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo_electronico = $_POST['correo_electronico'];
$contraseña = $_POST['contraseña'];
$cliente = $_POST['drone'];

$validar ="SELECT * FROM usuarios WHERE identificacion='$identificacion'";
$validando = mysqli_query($bd, $validar);
$filas=mysqli_num_rows($validando);

if($filas>0 ){
    echo "<script>alert('ya hay un usuario registrado con la misma identificacion');window.history.go(-1);</script>";
}else{
    $insertar_usuario = "INSERT INTO usuarios (identificacion, nombres, apellidos, correo_electronico, telefono, direccion, contraseña, estado_usuario, rol_fk) VALUES
    ('$identificacion','$nombres', '$apellidos', '$correo_electronico', '$telefono', '$direccion', '$contraseña', '1', '$cliente')";
    $resultado_usuario = mysqli_query($bd, $insertar_usuario);
    if($cliente=2){
        $insertar_descripcion = "INSERT INTO descripcion_abogado(descripcion, id_abogado) VALUES
        ('definir descripcion', '$identificacion')";
        $resultado_descripcion = mysqli_query($bd, $insertar_descripcion);
        echo "<script>alert('se ha registrado un nuevo abogado');window.location='administracion_inicio.php'</script>";
    }else{
        echo "<script>alert('se ha registrado un nuevo usuario');window.location='administracion_inicio.php'</script>";
    }
}
