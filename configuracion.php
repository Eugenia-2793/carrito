<?php

$PROYECTO = "carrito";

$GLOBALS['ROOT'] = $_SERVER['DOCUMENT_ROOT'] . "/carrito/";

$INICIO = "Location:http://" . $_SERVER['HTTP_HOST'] . "$PROYECTO" . "/vista/home/home/index.php";

include_once("util/funciones.php");

date_default_timezone_set('America/Argentina/Buenos_Aires'); 