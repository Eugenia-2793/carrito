<?php
$Titulo = "crear items";
include_once '../../estructura/cabecera.php';

 $datos = data_submitted();
 $AbmObjProducto = new AbmProducto;
 $enStock = $AbmObjProducto->enStock($datos);
  if($enStock){   
    $AbmObjItem = new AbmCompraItem;
    $itemscreados = $AbmObjItem->creaciondeitems($datos); 
    $mensaje = "Compra creada con exito"; //esto se puede mandar a otra vista pero lo imprimimmos por aca
    echo "<div class='alert alert-success d-flex align-items-center' role='alert'> <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg><div>" . $mensaje . "</div> </div> <a href='compra.php' class='btn btn-warning' >ver Compra</a>";
  }else{
    $mensaje = "No se pudo realizar su compra, vuelva y verifique stock";
    echo "<div class='alert alert-danger d-flex align-items-center' role='alert'> <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg> <div>" . $mensaje . "</div> </div> <a href='listarProductos.php' class='btn btn-warning' >ver Productos</a>";
  }

//pie
include_once("../../estructura/pie.php");
?>