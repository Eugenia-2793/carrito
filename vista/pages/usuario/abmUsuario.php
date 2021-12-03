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

/* Acción que permite: editar, borrar y crear un usuario */
if (isset($datos['accion'])) {
    $mensaje = "";

    /***  EDITAR ***/
    if ($datos['accion'] == 'editar') {
        if ($objUsuario->modificarUsuarioRol($datos)) {
            if ($objUsuario->modificacion($datos)) {
                $resp = true;
            } else {
                $mensaje = "<b>ERROR: </b>";
            }
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /***  EDITAR PERFIL ***/
    if ($datos['accion'] == 'editarPerfil') {
        if ($objUsuario->modificacion($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** BORRAR ***/
    if ($datos['accion'] == 'borrar') {
        // Le damos de baja al usuariorol
        if ($objUsuario->bajaUsuarioRolIngresante($datos)) {
            // Le damos de baja al usuario
            if ($objUsuario->baja($datos)) {
                $resp = true;
            } else {
                $mensaje = "<b>ERROR: </b>";
            }
        } else {
            $mensaje = "<b>ERROR: </b>";
        }
    }

    /*** CREAR ***/
    if ($datos['accion'] == 'crear') {
        if ($objUsuario->alta($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR:</b> definir la clave primaria para no repetir. ";
        }
    }

    /*** REGISTRAR ***/
    if ($datos['accion'] == 'registrar') {
        if ($objUsuario->alta($datos)) {
            $resp = true;
        } else {
            $mensaje = "<b>ERROR:</b> definir la clave primaria para no repetir. ";
        }
    }

    if ($resp) {
        $mensaje = "La acción <b>" . $datos['accion'] . " usuario</b> se realizo correctamente.";
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
<?php
if ($datos['accion'] == 'editarPerfil') {
    echo "<div class='mb-4'>
            <a class='btn btn-dark' href='../../pages/perfil/perfil.php' role='button'><i class='fas fa-angle-double-left'></i> Regresar</a>
        </div>";
} elseif ($datos['accion'] == 'registrar') {
    echo "<div class='mb-4'>
            <a class='btn btn-dark' href='../../pages/login/login.php' role='button'><i class='fas fa-angle-double-left'></i> Regresar</a>
        </div>";
} else {
    echo "<div class='mb-4'>
            <a class='btn btn-dark' href='../../pages/usuario/listar.php' role='button'><i class='fas fa-angle-double-left'></i> Regresar</a>
        </div>";
}


include_once("../../estructura/pie.php");
?>