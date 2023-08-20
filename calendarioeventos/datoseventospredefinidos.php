<?php
header('Content-Type: application/json');
session_start();
include("../php/session.php");
require("conexion.php");

$conexion = retornarConexion();

switch ($_GET['accion']) {
    case 'listar':
        $codigoEspecifico = $id;
        $datos = mysqli_query($conexion, "select codigo,titulo,horainicio,horafin,colortexto,colorfondo from eventospredefinidos where id_usuario = $codigoEspecifico or id_cliente = $codigoEspecifico ");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;

    case 'agregar':
        $respuesta = mysqli_query($conexion, "insert into eventospredefinidos(titulo,horainicio,horafin,colortexto,colorfondo, id_usuario, id_cliente) values 
                                                ('$_POST[titulo]','$_POST[horainicio]','$_POST[horafin]','$_POST[colortexto]','$_POST[colorfondo]', '$id'");
        echo json_encode($respuesta);
        break;

    case 'borrar':
        $respuesta = mysqli_query($conexion, "delete from eventospredefinidos where codigo=$_POST[codigo]");
        echo json_encode($respuesta);
        break;
}
