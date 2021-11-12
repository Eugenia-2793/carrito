<?php
include_once '../../../configuracion.php';
include_once '../../../control/Session.php';
include_once '../../../control/AbmUsuario.php';
include_once '../../../control/AbmUsuarioRol.php';
include_once '../../../modelo/Usuario.php';
include_once '../../../modelo/UsuarioRol.php';
include_once '../../../modelo/conector/BaseDatos.php';
include_once '../../../modelo/Rol.php';

$sesion = new Session();

if ($sesion->activa()) {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
        $Titulo = "Carrito";
        // Obtengo el usuario
        $user = $sesion->getUsuario();
        // Obtengo nombre y mail del usuario
        $name = $user->getusnombre();
        $mail = $user->getusmail();
        // Obtengo los roles del usuario
        $abmusuariorol = new AbmUsuarioRol;
        $descrp = $abmusuariorol->buscarRolesUsuario($user);
    } else {
        header('Location: ../../pages/login/cerrarSesion.php');
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap/5.1.3/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap/5.1.3/bootstrapValidator.min.css">
    <link type="text/css" rel="stylesheet" href="../../css/estilos.css" />

    <title><?php echo $Titulo; ?></title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav bg-gradient">
        <!-- Container wrapper -->
        <div class="container-fluid px-lg-5 px-3">
            <!-- Navbar brand -->
            <a class="navbar-brand fw-bold text-uppercase mb-0" href="../../home/home/index.php">CineUge</a>
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-lg-center me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../home/home/contacto.php">
                            <i class="fas fa-info-circle d-lg-none d-xl-none"></i>
                            <span>Contacto</span>
                        </a>
                    </li>
                    <?php
                    /* Mostramos los roles según corresponda */
                    if ($sesion->activa()) {
                        echo "<!-- Icon Roles -->
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown-Visitante' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='fas fa-eye'></i> <span class='d-lg-none'>Rol</span>
                            </a>
    
                            <div class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown-Visitante'>";
                        for ($i = 0; $i < count($descrp); $i++) {
                            switch ($descrp[$i]) {
                                case "Administrador":
                                    echo "<a class='dropdown-item' href='#'><i class='fas fa-crown'></i> Administrador</a>";
                                    break;
                                case "Deposito":
                                    echo "<a class='dropdown-item' href='#'><i class='fas fa-archive'></i> Deposito</a>";
                                    break;
                                case "Cliente":
                                    echo "<a class='dropdown-item' href='#'><i class='fas fa-user-tie'></i> Cliente</a>";
                                    break;
                            }
                        }
                        echo "</div>
                        </li>";
                    }
                    ?>
                </ul>
                <ul class="navbar-nav align-items-lg-center d-flex">

                    <!-- Icon carrito -->
                    <li class='nav-item'>
                        <a class='nav-link' href='../../pages/cliente/carrito.php' role='button' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-shopping-cart'></i> <span class='d-lg-none'>Carrito</span>
                        </a>
                    </li>

                    <?php
                    /* Mostramos el icono de usuario de acuerdo a si la sesion esta activa o no */
                    if (!$sesion->activa()) {
                        echo "<!-- Icon visitante -->
                        <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown-Visitante' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            <i class='fas fa-user-times'></i> <span class='d-lg-none'>Usuario</span>
                        </a>

                        <div class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown-Visitante'>
                            <a class='dropdown-item' href='../../pages/login/login.php'><i class='fas fa-sign-in-alt'></i> Login</a>
                            <a class='dropdown-item' href='../../pages/login/registrar.php'><i class='fas fa-pencil-alt'></i> Registrarse</a>
                        </div>
                        </li>";
                    } else {
                        echo "<!-- Icon usuario -->
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown-Usuario' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='fas fa-user'></i> <span class='d-lg-none'>Usuario</span>
                            </a>

                            <div class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown-Usuario'>
                                <a class='dropdown-item' href='../../pages/perfil/perfil.php'>
                                    <i class='fas fa-user'></i> Perfil
                                </a>
                                <a class='dropdown-item' href='../../pages/perfil/configuraciones.php'><i class='fas fa-cog'></i> Configuración</a>

                                <div class='dropdown-divider'></div>

                                <a class='dropdown-item logout' href='../../pages/login/cerrarSesion.php'><i class='fas fa-sign-out-alt'></i> Cerrar sesión</a>
                            </div>
                        </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="mx-auto my-5 px-md-5">