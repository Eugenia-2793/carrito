<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
if ($datos['accion'] == 'noAccion') {
    header('Location: listarProductos.php');
}

$Titulo = "ABM Producto";
include_once("../../estructura/cabecera.php");
include_once("../../../control/controlSubeArchivos.php");

$resp = false;
$objProducto = new AbmProducto();

/* Acción que permite: editar, borrar y crear un producto */
if (isset($datos['accion'])) {
    $mensaje = "";

    /***  EDITAR ***/
    if ($datos['accion'] == 'editar') {
        if ($objProducto->modificacion($datos)) {
            $obj = new controlArchivos();
            $mensaje = $obj->control_portada($datos['pronombre']);
            $link = $mensaje['imagen']['link'];
            $error = $mensaje['imagen']['error'];

            if ($datos['protipo'] == 'pelicula') {
                $obj2 = new controlArchivos();
                $obj2->crearDescripcionPelicula($datos['pronombre']);
                $respuesta = $obj2->verInformacion($_POST);
            }
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** BORRAR ***/
    if ($datos['accion'] == 'borrar') {
        if ($objProducto->baja($datos)) {
            /* Si es una película debemos borrar los archivos también */
            if ($datos['protipo'] == 'pelicula') {
                $obj2 = new controlArchivos();
                $obj2->borrarArchivos($datos['pronombre']);
            }
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** AGREGAR / CREAR ***/
    if ($datos['accion'] == 'crear') {
        if ($objProducto->alta($datos)) {
            $obj = new controlArchivos();
            $mensaje = $obj->control_portada($datos['pronombre']);
            $link = $mensaje['imagen']['link'];
            $error = $mensaje['imagen']['error'];

            if ($datos['protipo'] == 'pelicula') {
                $obj2 = new controlArchivos();
                $obj2->crearDescripcionPelicula($datos['pronombre']);
                $respuesta = $obj2->verInformacion($_POST);
            }
            $resp = true;
        } else {
            $mensaje = "<b>ERROR:</b> ¡Este producto ya existe! <br>";
        }
    }

    if ($resp) {
        $mensaje = "La acción <b>" . $datos['accion'] . " producto</b> se realizo correctamente.";
    } else {
        $mensaje .= "La acción <b>" . $datos['accion'] . " producto</b> no pudo concretarse.";
    }
}

$encuentraError = strpos(strtoupper($mensaje), 'ERROR');
?>

<!-- Mensaje Respuesta -->
<div class="row mb-2">
    <div>
        <?php

        if ($encuentraError > 0) {
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div>" . $mensaje . "</div>
                </div>";
        } else {
            if ($datos['accion'] == 'crear') {
                if ($datos['protipo'] == 'pelicula') {
                    echo "<div class='alert alert-dark' role='alert'>
                            <div class='row px-2 my-3'>
                                <div class='col-lg-7 col-xl-8'>$respuesta</div>
                                <div class='col-lg-5 col-xl-4 text-lg-end'><img class='img-fluid' alt='Portada' src='" . $link . "'></div>
                            </div>
                        </div>";
                }
            }
            echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                    <div>" . $mensaje . "</div>
                </div>";
        }

        ?>
    </div>
</div>

<!-- Botones -->
<div class="mb-4">
    <a class="btn btn-primary" href="listarProductos.php" role="button"><i class="fas fa-list"></i> Listar Productos</a>
</div>

<?php
include_once("../../estructura/pie.php");
?>