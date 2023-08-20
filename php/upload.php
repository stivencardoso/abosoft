<?php
session_start();
$caso  = $_SESSION['caso'];
// Comprobar si se ha cargado un archivo
if (isset($_FILES['archivo'])) {
    extract($_POST);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Definir la carpeta de destino
    $carpeta_destino = "../files/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["archivo"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "pdf" || $extension == "doc" || $extension == "docx") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
            // Insertar la información del archivo en la base de datos
            include "../conexion/cn.php";
            $sql = "INSERT INTO documento (nombre, descripcion, archivo, id_caso) 
            VALUES ( '$nombre', '$descripcion','$nombre_archivo','$caso')";
            $resultado = mysqli_query($bd, $sql);
            if ($resultado) {
                echo "<script language='JavaScript'>
                alert('Archivo Subido');
                location.assign('index.php');
                </script>";
            } else {

                echo "<script language='JavaScript'>
                alert('Error al subir el archivo: ');
                location.assign('index.php');
                </script>";
            }
        } else {
            echo "<script language='JavaScript'>
            alert('Error al subir el archivo. ');
            location.assign('index.php');
            </script>";
        }
    } else {
        echo "<script language='JavaScript'>
        alert('Solo se permiten archivos PDF, DOC y DOCX.');
        location.assign('index.php');
        </script>";
    }
}
