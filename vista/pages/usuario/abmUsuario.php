<?php
include_once '../../../configuracion.php';
$datos = data_submitted();
if ($datos['accion'] == 'noAccion') {
    header('Location: listar.php');
}

$Titulo = "ABM Usuario";
include_once("../../estructura/cabecera.php");

$resp = false;
$objUsuario = new AbmUsuario();
$objUsuarioRol = new AbmUsuarioRol();
$filtro = array();
$filtro['idusuario'] = $datos['idusuario'];

/* Accion que permite: cargar una nueva persona, borrar y editar */
if (isset($datos['accion'])) {
    $mensaje = "";

    /***  EDITAR ***/
    if ($datos['accion'] == 'editar') {
        $datos['uspass'] = md5($datos['uspass']);
        $unabmUser = new AbmUsuario();
        $unUser = $unabmUser->buscar($filtro); // Usuario
        $idRolesUser = $objUsuarioRol->buscarRolesUsuario($unUser[0]); // Roles actuales del usuario

        $nuevoRol = $datos['nuevoRol'];
        $filtroRol = array(); // Rol actual de la colección de roles y el id de usuario
        $filtroRol['idusuario'] = $datos['idusuario'];
        //$roles = $objUsuarioRol->buscar($filtro); // Roles del usuario

        // Agregamos lo nuevos roles
        foreach ($nuevoRol as $idNuevoRol) {
            $filtroRol['idrol'] = $idNuevoRol;
            $existerol = $objUsuarioRol->buscar($filtroRol);
            // Comprobamos que el usuario no tenga el rol con el id actual de la iteracion para agregarlo
            if ($existerol == null) {
                $objUsuarioRol->alta($filtroRol);
            }
        }

        // Creamos un arreglo con los roles que debemos quitar
        $noRoles = []; // Arreglo con los roles que no tiene el usuario
        foreach ($idRolesUser as $unRol) {
            $encuentra = true;
            // Verifico que hayan roles en nuevoRol, si no, le asigno todos los roles de idRolesUser
            if ($nuevoRol != null) {
                for ($i = 0; $i < count($nuevoRol); $i++) {
                    if ($nuevoRol[$i] == $unRol) {
                        $encuentra = false;
                    }
                }
                if ($encuentra) {
                    array_push($noRoles, $unRol);
                }
            } else {
                array_push($noRoles, $unRol);
            }
        }

        // Quitamos los roles que ya no estén
        foreach ($noRoles as $unNoRol) {
            $filtroRolDelete = array(); // Rol actual de la colección de roles y el id de usuario
            $filtroRolDelete['idusuario'] = $datos['idusuario'];
            $filtroRolDelete['idrol'] = $unNoRol;

            $existeNorol = $objUsuarioRol->buscar($filtroRolDelete);
            // Comprobamos que el usuario no tenga el rol con el id actual de la iteracion para eliminarlo
            if ($existeNorol != null) {
                $objUsuarioRol->baja($filtroRolDelete);
            }
        }


        if ($objUsuario->modificacion($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /***  EDITAR PERFIL ***/
    if ($datos['accion'] == 'editarPerfil') {
        if ($datos['uspass'] == "null") {
            $unabmUser = new AbmUsuario();
            $unUser = $unabmUser->buscar($filtro);
            $pass = $unUser[0]->getuspass();
            $datos['uspass'] = $pass;
        } else {
            $datos['uspass'] = md5($datos['uspass']);
        }
        if ($objUsuario->modificacion($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** BORRAR ***/
    if ($datos['accion'] == 'borrar') {
        // Quitamos los roles del usuario
        $abmusuariorol = new AbmUsuarioRol;
        $user = $objUsuario->buscar($filtro);
        $idrol = $abmusuariorol->buscarRolesUsuario($user[0]);
        foreach ($idrol as $unRol) {
            $filtroRolDelete = array(); // Rol actual de la colección de roles y el id de usuario
            $filtroRolDelete['idusuario'] = $datos['idusuario'];
            $filtroRolDelete['idrol'] = $unRol;
            $objUsuarioRol->baja($filtroRolDelete);
        }
        if ($objUsuario->baja($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** CREAR ***/
    if ($datos['accion'] == 'crear') {
        $datos['uspass'] = md5($datos['uspass']);
        if ($objUsuario->alta($datos)) {
            // if ($objUsuario->altaUsuarioRolExistente($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR:</b> definir la clave primaria para no repetir";
        }
    }

    if ($resp) {
        $mensaje = "La acción <b>" . $datos['accion'] . " usuario</b> se realizo correctamente";
    } else {
        $mensaje .= "La acción <b>" . $datos['accion'] . " usuario</b> no pudo concretarse.";
    }
}

$encuentraError = strpos(strtoupper($mensaje), 'ERROR');
?>

<!-- Mensaje Respuesta -->
<div class="row mb-2">
    <div>
        <?php

        if ($encuentraError > 0) {
            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
        <div>" . $mensaje . "</div>
        </div>";
        } else {
            echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
        <div>" . $mensaje . "</div>
        </div>";
        }

        ?>
    </div>
</div>

<!-- Botones -->
<div class="mb-4">
    <a class="btn btn-dark" href="../../pages/usuario/listar.php" role="button"><i class="fas fa-angle-double-left"></i> Regresar</a>
</div>

<?php
include_once("../../estructura/pie.php");
?>