<?php
$Titulo = "ver compra";
include_once '../../estructura/cabecera.php';
$encuentraRol = false;
if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol  == 3) {
            $encuentraRol = true;
        }
    }
}
if ($encuentraRol) {

    //con permiso de usario
    
$datos = data_submitted();
$resp = false;
$objCompraEstado = new AbmCompraEstado;

/* Acción que permite: editar un compraestado */
$mensaje = "";

/***  CANCELAR ***/
if ($objCompraEstado->cancelarCompra($datos)) {
    $resp = true;
} else {
    $mensaje = "<b>ERROR: </b>";
}

if ($resp) {
    $mensaje = "La acción <b> Cancelar Compra</b> se realizo correctamente.";
} else {
    $mensaje .= "La acción <b> Cancelar Compra</b> no pudo concretarse.";
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
<div class='mb-4'>
    <a class='btn btn-dark' href='../../pages/carritos/listar.php' role='button'><i class='fas fa-angle-double-left'></i> Regresar</a>
</div>

<?php

  //con permiso de usario
  } else {
     include_once("../../pages/login/sinPermiso.php");
  }

include_once("../../estructura/pie.php");
?>