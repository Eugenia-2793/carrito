<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
if ($datos['accion'] == 'noAccion') {
    header('Location: listar.php');
}

$Titulo = "ABM Rol";
include_once("../../estructura/cabecera.php");

$resp = false;
$objRol = new AbmRol();


/* Acción que permite: editar, borrar y crear un rol */
if (isset($datos['accion'])) {
    $mensaje = "";

    /***  EDITAR ***/
    if ($datos['accion'] == 'editar') {
        if ($objRol->modificacion($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** BORRAR ***/
    if ($datos['accion'] == 'borrar') {
        if ($objRol->baja($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** CREAR ***/
    if ($datos['accion'] == 'crear') {
        if ($objRol->alta($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR:</b> definir la clave primaria para no repetir";
        }
    }

    if ($resp) {
        $mensaje = "La acción <b>" . $datos['accion'] . " rol</b> se realizo correctamente.";
    } else {
        $mensaje .= "La acción <b>" . $datos['accion'] . " rol</b> no pudo concretarse.";
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
    <a class="btn btn-dark" href="../../pages/roles/listar.php" role="button"><i class="fas fa-angle-double-left"></i> Regresar</a>
</div>

<?php
include_once("../../estructura/pie.php");
?>