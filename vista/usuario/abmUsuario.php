<?php
$Titulo = "ABM Usuarios";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$resp = false;
$objTrans = new AbmUsuario();

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
    if ($datos['accion'] == 'nueva') {
        if ($objTrans->alta($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR:</b> definir la clave primaria para no repetir";
        }
    }
    if ($resp) {
        $mensaje = "La acción <b>" . $datos['accion'] . " usuario</b> se realizo correctamente.";
    } else {
        $mensaje .= "La acción <b>" . $datos['accion'] . " usuario</b> no pudo concretarse.";
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

    <!-- Botones -->
    <div class="mb-5">
        <a class="btn btn-primary" href="nuevo.php" role="button"><i class="fas fa-plus"></i> Alta</a>
        <a class='btn btn-success' href='editar.php' role='button'><i class="fas fa-search"></i> Modificacion</a>
        <a class='btn btn-success' href='listar.php' role='button'><i class="fas fa-search"></i> Listar</a>
        <a class='btn btn-danger' href='borrar.php' role='button'><i class="fas fa-eye"></i> Baja</a>
    </div>
</div>

<?php
include_once("../../estructura/pieBT.php");
?>