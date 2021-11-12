<?php
$Titulo = "Inicio";
include_once("../../estructura/cabecera.php");
include_once("../../../control/controlSubeArchivos.php");
$obj = new controlArchivos();
$arreglo = $obj->obtenerArchivos();
?>

<div class="container-lg p-3">
    <h2 class="mb-4 text-center text-uppercase">Cartelera</h2>

    <form id="ejeArchivos" name="ejeArchivos" method="POST" action="accionIndex.php">
        <div class="row">
            <?php
            foreach ($arreglo as $archivo) {
                if (strlen($archivo) > 2 && strpos($archivo, "txt") <= 0  && strpos($archivo, "pdf") <= 0) {
                    echo    "<div id='pelis' class='d-grid col-lg-2 col-sm-4 mb-4'>
                           <div class='jojo'> <img class='img-fluid' alt='$archivo' src='../../../uploads/$archivo' width='100%'></div>
                            <div class='d-grid align-items-end'>
                                <input type='submit' name='Seleccion:$archivo' id='Seleccion:$archivo' class='btn btn-verPeli rounded-bottom' value='Ver detalles'>
                            </div>
                        </div>";
                }
            }

            if ($sesion->activa()) {
                $bandera = false;
                for ($i = 0; $i < count($descrp) && !$bandera; $i++) {
                    if ($descrp[$i] == "Administrador" || $descrp[$i] == "Deposito") {
                        echo "<div id='agregarPelis' class='d-grid col-lg-2 col-sm-4 mb-4'>
                            <a class='btn d-flex justify-content-center align-items-center fs-1 bg-light' href='../../pages/deposito/agregarProducto.php' role='button'><i class='fas fa-plus'></i></a>
                        </div>";
                        $bandera = true;
                    }
                }
            }
            ?>
        </div>
    </form>


    <!-- Lista de productos -->
    <!-- <div class="row row-cols-1 row-cols-md-3">
        <div class="col mb-4">
            <div class="card h-100">-->
    <!-- Imagen Producto -->
    <!--<img src="../../img/imageCap.jpg" class="card-img-top" alt="unProducto">-->
    <!-- Nombre y Descripción del Producto -->
    <!--<div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                </div>-->
    <!-- Botones para añadir, modificar o eliminar Producto -->
    <!--<div class="card-footer">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary">Añadir al Carrito <i class="fas fa-cart-plus"></i></button>

                        <div class="btn-group btn-group-sm btn-block" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success">Modificar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>


<?php
include_once("../../estructura/pie.php");
?>