<?php
$Titulo = "ver compras";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();
// echo "</br>Por data_submited</br>";
// print_r($datos);
// echo "</br>--------------------</br>";
//Array ( [idproducto] => Array ( [0] => 1 [1] => 2 ) [idcompra] => 27 [proprecio] => Array ( [0] => 350 [1] => 350 ) [cicantidad] => Array ( [0] => 2 [1] => 2 ) )

//HACER.
//mando los datos a crear items y luego los listo con el estado de la compra,
//esto queda en vista del usuario como algo q solo puede eliminar.


$AbmObjItem = new AbmCompraItem;
$lositems = $AbmObjItem->altavariositems($datos);

print_r($lositems);

















include_once("../../estructura/pie.php");
?>