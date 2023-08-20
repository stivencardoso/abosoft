<?php
/*
* Script: Cargar datos de lado del servidor con PHP y MySQL
* Autor: Marco Robles
* Team: Códigos de Programación
*/


include("../conexion/cn.php");

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['identificacion', 'nombres', 'apellidos', 'telefono', 'correo_electronico', 'direccion', 'contraseña','rol_fk'];

/* Nombre de la tabla */
$table = "usuarios";

$id = 'identificacion';

$campo = isset($_POST['campo']) ? $bd->real_escape_string($_POST['campo']) : null;


/* Filtrado */
$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columns);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ") ";
}

/* Limit */
$limit = isset($_POST['registros']) ? $bd->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $bd->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

/**
 * Ordenamiento
 */

 $sOrder = "";
 if(isset($_POST['orderCol'])){
    $orderCol = $_POST['orderCol'];
    $oderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';
    
    $sOrder = "ORDER BY ". $columns[intval($orderCol)] . ' ' . $oderType;
 }


/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where
$sOrder
$sLimit";
$resultado = $bd->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $bd->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT count($id) FROM $table WHERE rol_fk = '2'";
$resTotal = $bd->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalFiltro;
$output['totalFiltro'] = $totalRegistros;
$output['data'] = '';
$output['paginacion'] = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        if ($row['rol_fk']==2){
            $output['data'] .= '<tr>';
            $output['data'] .= '<td>' . $row['identificacion'] . '</td>';
            $output['data'] .= '<td>' . $row['nombres'] . '</td>';
            $output['data'] .= '<td>' . $row['apellidos'] . '</td>';
            $output['data'] .= '<td>' . $row['telefono'] . '</td>';
            $output['data'] .= '<td>' . $row['correo_electronico'] . '</td>';
            $output['data'] .= '<td>' . $row['direccion'] . '</td>';
            $output['data'] .= '<td>' . $row['contraseña'] . '</td>';
            $output['data'] .= '<td><a class="btn btn-warning btn-sm" href="editar.php?id=' . $row['identificacion'] . '">Editar</a></td>';
            $output['data'] .= "<td><a class='btn btn-danger btn-sm' href='eliminar.php?id=" . $row['identificacion'] . "'>Eliminar</a></td>";
            $output['data'] .= '</tr>';
        }
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if(($pagina - 4) > 1){
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if($numeroFin > $totalPaginas){
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a></li>';
        }
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);