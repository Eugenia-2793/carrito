<?php
$Titulo = "ver compra";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();
 echo "</br>Por data_submited</br>";
 print_r($datos);
 echo "</br>--------------------</br>";
//Array ( [idproducto] => Array ( [0] => 1 [1] => 2 ) [idcompra] => 27 [proprecio] => Array ( [0] => 350 [1] => 350 ) [cicantidad] => Array ( [0] => 2 [1] => 2 ) )

//HACER.
//mando los datos a crear items y luego los listo con el estado de la compra,
//esto queda en vista del usuario como algo q solo puede eliminar.

  $AbmObjItem = new AbmCompraItem;
  $AbmObjItem->altavariositems($datos);
  $filtro= $datos['idcompra'];
  //echo "filtro con id compra = $filtro";
  $itemsdecompra = $AbmObjItem->buscar($filtro);
  $cantidad = count($itemsdecompra);
  //echo "cantidad de item: $cantidad";
  //print_r($itemsdecompra);

  $AbmObjCompra = new AbmCompra;
  $filtro= $datos['idcompra'];
  // echo "filtro </br> $filtro";
  $compraunica = $AbmObjCompra->buscar($filtro);
  //actualizar el precio de la compra:
 $precio = $AbmObjCompra->actualizarprecio($itemsdecompra, $filtro);
 //$mostrarCompra = $AbmObjCompra->mostrarCompra($compraunica);



include_once("../../estructura/pie.php");
?>