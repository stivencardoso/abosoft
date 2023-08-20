<?php
session_start();
$id = $_SESSION['id'];
include("../conexion/cn.php");
$nombres = $_POST['nombres'];
$descripcion = $_POST['descripcion'];
$cliente = $_SESSION['cliente'];
$caso = "SELECT * FROM caso";
$resul = mysqli_query($bd, $caso);
$i = 0;
while($row=mysqli_fetch_assoc($resul)) {
    $i = $row['id_caso'];
    $si = $i+1;
}
$insertar = "INSERT INTO caso(id_caso, nombre_caso, descripcion, estado_fk) VALUES
            ('$si','$nombres', '$descripcion', 1)";
$insertar1 = "INSERT INTO caso_usuario( usuario_fk, caso_fk) VALUES
            ('$id', '$si')";
$insertar2 = "INSERT INTO caso_usuario( usuario_fk, caso_fk) VALUES
            ('$cliente', '$si')";
$resultado = mysqli_query($bd, $insertar);
$resultado1 = mysqli_query($bd, $insertar1);
$resultado2 = mysqli_query($bd, $insertar2);
if($resultado){
    echo "<script>alert('se ha registrado el nuevo caso');window.location='abogado_procesos.php'</script>";
}