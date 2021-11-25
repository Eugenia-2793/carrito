<?php
include_once '../../../configuracion.php';


$sesion = new Session();
$datos = data_submitted();
print_r($datos);

if (!$sesion->activa()) {
    header('Location: ../login/login.php');
} else {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
        $user = $sesion->getUsuario();
        $usrol = $sesion->getRol();
        $rol = $usrol[0]->getobjrol();
        $descrp = $rol->getroldescripcion();
        var_dump($descrp);
        $Titulo = "Carrito";
        include_once("../../estructura/cabecera.php");
    } else {
        header('Location: ../login/cerrarSesion.php');
    }
}
?>



<?php
include_once("../../estructura/pie.php");
?>