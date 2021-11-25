<?php
include_once '../../../configuracion.php';

$datos = data_submitted();
$sesion = new Session();
$name = $datos['usnombre'];
$pass = md5($datos['uspass']);
$sesion->iniciar($name, $pass);
list($valido, $error) = $sesion->validar();

if ($valido) {
    header("Location:../../home/home/index.php");
} else {
    $sesion->cerrarSession();
    header("Location:login.php?error=" . urlencode($error));
}
