<?php
$Titulo = "ver compra";
include_once '../../estructura/cabecera.php';
    
$datos = data_submitted();
$resp = false;
$objCompraEstado = new AbmCompraEstado;
$mensaje = "";

   if ($objCompraEstado->cancelarCompra($datos)) {
     $resp = true;
     $mensaje = "La acción <b> Cancelar Compra</b> se realizo correctamente.";
     echo "<div class='alert alert-danger d-flex align-items-center' role='alert'> <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg> <div>" . $mensaje . "</div> </div> <a class='btn btn-dark' href='../../pages/cliente/historial.php' role='button'><i class='fas fa-angle-double-left'></i> Historial</a>";
   } else {
     $mensaje .= "La acción <b> Cancelar Compra</b> no pudo concretarse.";
     echo "<div class='alert alert-success d-flex align-items-center' role='alert'> <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg> <div>" . $mensaje . "</div> </div> <div class='mb-4'> <a class='btn btn-dark' href='../../pages/cliente/historial.php' role='button'><i class='fas fa-angle-double-left'></i> Historial</a> ";
    }

include_once("../../estructura/pie.php");
?>