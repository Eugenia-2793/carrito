<?php
$Titulo = "ver compras";
include_once '../../estructura/cabecera.php';

$datos = data_submitted();
print_r($datos);
echo "</br>--------------------</br>";
//Array ( [idproducto] => Array ( [0] => 1 [1] => 2 ) [idcompra] => 27 [proprecio] => Array ( [0] => 350 [1] => 350 ) [cicantidad] => Array ( [0] => 2 [1] => 2 ) )

include_once("../../estructura/pie.php");
?>