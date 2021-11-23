<?php
$Titulo = "Inicio";
include_once("../../estructura/cabecera.php");
include_once("../../../control/controlSubeArchivos.php");

//Guardo todos los productos en un arreglo
$abmProducto = new AbmProducto;
$arregloProductos = $abmProducto->buscar(null);

?>

<div class="container-lg p-3">

    <form id="ejeArchivos" name="ejeArchivos" method="POST" action="accionIndex.php">
        <!-- Combos -->
        <h2 class="mb-4 text-center text-uppercase">Combos</h2>
        <div id="combos" class="row justify-content-center mb-5">
            <?php
            foreach ($arregloProductos as $unProducto) {
                $nompro = $unProducto->getProNombre();
                $detallepro = $unProducto->getProDetalle();
                $tipopro = $unProducto->getProTipo();
                $stockpro = $unProducto->getProStock();
                $preciopro = $unProducto->getProPrecio();
                if ($tipopro != "pelicula") {
                    // $obj = new controlArchivos();
                    // $archivo = $obj->obtenerUnaImg($nompro);
                    echo    "<div class='d-grid col-lg-3 col-md-4 col-sm-6 mb-4 h-100'>
                                <div class='imgProducto'> <img class='img-fluid' alt='$nompro' src='../../img/imageCap.jpg' width='100%'></div>
                                <div class='d-grid align-items-end'>
                                    <input type='submit' name='Seleccion:$nompro' id='Seleccion:$nompro' class='btn btn-verProducto text-uppercase fw-bold' value='$nompro'>
                                </div>
                                <div class='shadow-sm'>
                                    <ul class='list-group list-group-flush rounded-bottom'>
                                        <li class='list-group-item d-flex align-items-center'>
                                            $detallepro
                                        </li>
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class='fw-bold'>Precio</span>
                                            <span class='badge bg-warning text-dark'>$$preciopro</span>
                                        </li>
                                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                                            <span class='fw-bold'>Stock</span>
                                            <span class='badge bg-success'>$stockpro</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>";
                }
            }

            /* Botón para agregar un nuevo Combo */
            if ($sesion->activa()) {
                $bandera = false;
                for ($i = 0; $i < count($idrol) && !$bandera; $i++) {
                    if ($selectRol == "2") {
                        echo "<div id='agregarPelis' class='d-grid col-lg-3 col-md-6 col-sm-4 mb-4'>
                            <a class='btn d-flex justify-content-center align-items-center fs-1 bg-light rounded' href='../../pages/Deposito/agregarProducto.php' role='button'><i class='fas fa-plus'></i></a>
                        </div>";
                        $bandera = true;
                    }
                }
            }
            ?>
        </div>
        <!-- Fin Combos -->
        <!-- Cartelera -->
        <h2 class="mb-4 text-center text-uppercase">Cartelera</h2>
        <div id="pelis" class="row">
            <?php
            foreach ($arregloProductos as $unProducto) {
                $nompro = $unProducto->getProNombre();
                $tipopro = $unProducto->getProTipo();
                if ($tipopro == "pelicula") {
                    $obj = new controlArchivos();
                    $archivo = $obj->obtenerUnaImg($nompro);
                    echo    "<div class='d-grid col-xl-2 col-lg-3 col-sm-4 mb-4'>
                                <div class='imgProducto'> <img class='img-fluid' alt='$archivo' src='../../../uploads/$archivo' width='100%'></div>
                                <div class='d-grid align-items-end'>
                                    <input type='submit' name='Seleccion:$archivo' id='Seleccion:$archivo' class='btn btn-verProducto rounded-bottom' value='$nompro'>
                                </div>
                            </div>";
                }
            }

            /* Botón para agregar una nueva Película */
            if ($sesion->activa()) {
                $bandera = false;
                for ($i = 0; $i < count($idrol) && !$bandera; $i++) {
                    if ($selectRol == "2") {
                        echo "<div id='agregarPelis' class='d-grid col-xl-2 col-lg-3 col-sm-4 mb-4'>
                            <a class='btn d-flex justify-content-center align-items-center fs-1 bg-light rounded' href='../../pages/Deposito/agregarProducto.php' role='button'><i class='fas fa-plus'></i></a>
                        </div>";
                        $bandera = true;
                    }
                }
            }
            ?>
        </div>
        <!-- Fin Cartelera -->
    </form>

</div>


<?php
include_once("../../estructura/pie.php");
?>