<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
$respuesta = false;

if (isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail']) && isset($datos['usdeshabilitado'])) {
    if ($datos['usdeshabilitado'] == "0000-00-00 00:00:00") {
        $datos['usdeshabilitado'] = date("Y-m-d H:i:s");
    } else {
        $datos['usdeshabilitado'] = "0000-00-00 00:00:00";
    }
    $objUsuario = new AbmUsuario();
    $respuesta = $objUsuario->modificacion($datos);
} else {
    $mensaje = "La acción DESHABILITAR usuario no pudo concretarse.";
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)) {
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);
