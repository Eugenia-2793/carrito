<?php
// initialize shopping cart class
$Titulo = "Editar usuarios";
include_once("../../estructura/cabecera.php");


//validar si el usuario tiene una comrpa realizada/ segun el estado creo


$AbmCompra = new Compra;

//idcompra, cofecha, idusuario



$datos = data_submitted(); 
$AbmProducto = new AbmProducto;
$filtro = array();
$filtro['idproducto'] = $datos['producto'];
$unProducto = $AbmProducto->buscar($filtro);
