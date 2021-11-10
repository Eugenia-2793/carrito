<?php
include_once '../../configuracion.php';
include_once '../../control/Session.php';
include_once '../../control/AbmUsuario.php';
include_once '../../modelo/Usuario.php';
include_once '../../modelo/conector/BaseDatos.php';

$datos = data_submitted();
$sesion = new Session();
$name = $datos['usnombre'];
$pass = $datos['uspass'];
$sesion->iniciar($name, $pass);
list($valido, $error) = $sesion->validar();

if ($valido) {
    header("Location:../pages/carrito.php");
} else {
    $sesion->cerrarSession();
    header("Location:login.php?error=" . urlencode($error));
}
