<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
$respuesta = false;

if (isset($data['idusuario']) && isset($data['usnombre']) && isset($data['uspass']) && isset($data['usmail']) && isset($data['usdeshabilitado']) && isset($data['nuevoRol'])) {
    // Modificamos el usuariorol
    if ($objUsuario->modificarUsuarioRol($datos)) {
        // Modificamos el usuario
        if ($objUsuario->modificacion($datos)) {
            $respuesta = true;
        } else {
            $mensaje = "La acción Editar usuario no pudo concretarse.";
        }
    } else {
        $mensaje = "La acción Editar usuario no pudo concretarse.";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)) {

    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);
