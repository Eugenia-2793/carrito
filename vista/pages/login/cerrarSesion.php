<?php
include_once '../../../configuracion.php';
include_once '../../../control/Session.php';

$sesion = new Session();
$sesion->cerrarSession();
$message = "Sesión cerrada";
header('Location: login.php?message=' . urlencode($message));
