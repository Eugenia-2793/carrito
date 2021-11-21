<?php
$Titulo = "ABM Rol";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$resp = false;
$objTrans = new AbmRol();


/* Accion que permite: cargar una nueva persona, borrar y editar */
if (isset($datos['accion'])) {
    $mensaje = "";
    if ($datos['accion'] == 'editar') {
        if ($objTrans->modificacion($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }
    if ($datos['accion'] == 'borrar') {
        if ($objTrans->baja($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }
    if ($datos['accion'] == 'crear') {
        if ($objTrans->alta($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR:</b> definir la clave primaria para no repetir";
        }
    }
    if ($resp) {
        $mensaje = "La acción <b>" . $datos['accion'] . " rol</b> se realizo correctamente.s";

    } else {
        $mensaje .= "La acción <b>" . $datos['accion'] . " rol</b> no pudo concretarse.";
    }
}

$encuentraError = strpos(strtoupper($mensaje), 'ERROR');
?>

<div class="row mb-5">
    <div>
        <?php

        if ($encuentraError > 0) {
            echo "<div class='alert alert-danger d-flex align-items-center mt-5' role='alert'>
        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
        <div>" . $mensaje . "</div>
        </div>";
        } else {
            echo "<div class='alert alert-success d-flex align-items-center mt-5' role='alert'>
        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>" . $mensaje . "</div>
        </div>";
        }

        ?>
    </div>
</div>

<a class="dropdown-item" href="../../pages/roles/listar.php">
    <span class="fas fa-users fa-fw" aria-hidden="true" title="roles"> </span> Volver a Roles
</a>

<?php
include_once("../../estructura/pie.php");
?>