<?php 
session_start();
include("session.php");
$usuarios = "SELECT * FROM usuarios WHERE identificacion = '$id'";
include("../conexion/cn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/final.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-black">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Abogado</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="../calendarioeventos/index.php">calendario de eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_formulario.php">Registrar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_clientes.php">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_procesos.php">Procesos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="abogado_descripcion.php">Perfil Abogado</a>
        </li>
      </ul>
      <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 4%;">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg> Usuario
            </a> 
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="abogado_perfil.php">Mi perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item salir" href="cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<main>
        <div class="container shadow p-3 mb-5 bg-body-tertiary border border-3 rounded py-4 text-center p-3 mb-2 bg-light-subtle text-emphasis-light" style="margin-top: 3%;">
            <h2>Clientes</h2>
            <div class="row g-4">
                <div class="col-auto">
                    <label for="num_registros" class="col-form-label">Mostrar: </label>
                </div>
                <div class="col-auto">
                    <select name="num_registros" id="num_registros" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="num_registros" class="col-form-label">registros </label>
                </div>
                <div class="col-5"></div>
                <div class="col-auto">
                    <label for="campo" class="col-form-label">Buscar: </label>
                </div>
                <div class="col-auto">
                    <input type="text" name="campo" id="campo" class="form-control">
                </div>
            </div>
            <div class="row py-4">
                <div class="col table-responsive">
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <th class="sort asc">identificacion</th>
                            <th class="sort asc">Nombres</th>
                            <th class="sort asc">Apellidos</th>
                            <th class="sort asc">telefono</th>
                            <th class="sort asc">Correo_electronico</th>
                            <th class="sort asc">Direccion</th>
                            <th class="sort asc">Contraseña</th>
                            <th></th>
                        </thead>
                        <!-- El id del cuerpo de la tabla. -->
                        <tbody id="content">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label id="lbl-total"></label>
                </div>
                <div class="col-6" id="nav-paginacion"></div>
                <input type="hidden" id="pagina" value="1">
                <input type="hidden" id="orderCol" value="0">
                <input type="hidden" id="orderType" value="asc">
            </div>
        </div>
    </main>
    <script>
        /* Llamando a la función getData() */
        getData()
        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", function() {
            getData()
        }, false)
        document.getElementById("num_registros").addEventListener("change", function() {
            getData()
        }, false)
        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")
            let pagina = document.getElementById("pagina").value
            let orderCol = document.getElementById("orderCol").value
            let orderType = document.getElementById("orderType").value
            if (pagina == null) {
                pagina = 1
            }
            let url = "abogado_clientes_load.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('pagina', pagina)
            formaData.append('orderCol', orderCol)
            formaData.append('orderType', orderType)
            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro +
                        ' de ' + data.totalRegistros + ' registros'
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion
                }).catch(err => console.log(err))
        }
        function nextPage(pagina){
            document.getElementById('pagina').value = pagina
            getData()
        }
        let columns = document.getElementsByClassName("sort")
        let tamanio = columns.length
        for(let i = 0; i < tamanio; i++){
            columns[i].addEventListener("click", ordenar)
        }
        function ordenar(e){
            let elemento = e.target
            document.getElementById('orderCol').value = elemento.cellIndex
            if(elemento.classList.contains("asc")){
                document.getElementById("orderType").value = "asc"
                elemento.classList.remove("asc")
                elemento.classList.add("desc")
            } else {
                document.getElementById("orderType").value = "desc"
                elemento.classList.remove("desc")
                elemento.classList.add("asc")
            }
            getData()
        }
    </script>
<script src="../js/cerrarsesion.js"></script>
</body>
</html>