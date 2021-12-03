<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
$respuesta = false;

if (isset($data['idusuario']) && isset($data['usnombre']) && isset($data['uspass']) && isset($data['usmail']) && isset($data['usdeshabilitado'])) {
    $datos['uspass'] = md5($datos['uspass']);
    $objUsuario = new AbmUsuario();
    $respuesta = $objUsuario->alta($datos);
    if (!$respuesta) {
        $mensaje = " La acción ALTA no pudo concretarse.";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)) {

    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);
