<?php
include_once '../../../configuracion.php';

$sesion = new Session();

if ($sesion->activa()) {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
        // Obtengo el usuario
        $user = $sesion->getUsuario();
        // Obtengo nombre y mail del usuario
        $name = $user->getusnombre();
        $mail = $user->getusmail();
        // Obtengo los roles del usuario
        $abmusuariorol = new AbmUsuarioRol;
        $idrol = $abmusuariorol->buscarRolesUsuario($user);
    } else {
        header('Location: ../../pages/login/cerrarSesion.php');
    }
}

// Obtengo los roles del usuario
$abmmenu = new AbmMenu;
$menus = $abmmenu->buscar(null);

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
    <link rel="stylesheet" type="text/css" href="../../js/jquery-easyui-1.6.6/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../../js/jquery-easyui-1.6.6/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../../js/jquery-easyui-1.6.6/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../../js/jquery-easyui-1.6.6/demo/demo.css">
    <script type="text/javascript" src="../../js/jquery-easyui-1.6.6/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/jquery-easyui-1.6.6/jquery.easyui.min.js"></script>

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

            <!------------------------------------------------------------------>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-lg-center me-auto mb-2 mb-lg-0">
                    <!-- Contacto -->
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../home/home/contacto.php">
                            <i class="fas fa-info-circle d-lg-none d-xl-none"></i>
                            <span>Contacto</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../pages/cliente/listarProductos.php">
                            <i class="fas fa-info-circle d-lg-none d-xl-none"></i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <?php
                    /* Mostramos los roles según corresponda */
                    /*if ($sesion->activa()) {
                        echo "<!-- Icon Roles -->
                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown-Visitante' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                <i class='fas fa-eye'></i> <span class='d-lg-none'>Rol</span>
                            </a>
    
                            <div class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdown-Visitante'>";
                        for ($i = 0; $i < count($idrol); $i++) {
                            // Obtengo los menurol
                            $abmmenurol = new AbmMenuRol;
                            $unMenuRol = array();
                            $unMenuRol['idrol'] = $idrol[$i];
                            $menurol = $abmmenurol->buscar($unMenuRol);
                            $nombreMenu = $menurol[0]->getIdMenu()->getMeNombre();
                            echo "<a class='dropdown-item' href='#'>" . $nombreMenu . "</a>";
                        }
                        echo "</div>
                        </li>";
                    }*/


                    /** PRUEBA SELECT **/
                    if ($sesion->activa()) {
                        echo "<!-- Icon Roles -->
                        <li class='nav-item dropdown'>
                        <form action='' method='post'>
                        <select id='selectRol' name='selectRol' class='form-select' aria-label='Seleccionar Rol' onchange='this.form.submit()'>
                        <option value=''>Seleccione un Rol</option>";
                        for ($i = 0; $i < count($idrol); $i++) {
                            // Obtengo los menurol
                            $abmmenurol = new AbmMenuRol;
                            $unMenuRol = array();
                            $unMenuRol['idrol'] = $idrol[$i];
                            $menurol = $abmmenurol->buscar($unMenuRol);
                            $idmenu = $menurol[0]->getIdMenu()->getIdMenu();
                            $nombreMenu = $menurol[0]->getIdMenu()->getMeNombre();
                            echo "<option value='" . $idmenu . "'>" . $nombreMenu . "</option>";
                        }
                        echo "</select></form>";
                    }

                    ?>
                </ul>
                <ul class="navbar-nav align-items-lg-center d-flex">

                    <!-- Icon carrito -->
                    <li class='nav-item'>
                        <a class='nav-link' href='../../pages/cliente/compra.php' role='button' aria-haspopup='true' aria-expanded='false'>
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
                                    Ver Perfil
                                </a>";
                        $selectRol = "";
                        for ($i = 0; $i < count($idrol); $i++) {
                            // Obtengo los menurol
                            $abmmenurol = new AbmMenuRol;
                            $unMenuRol = array();
                            $unMenuRol['idrol'] = $idrol[$i];
                            $menurol = $abmmenurol->buscar($unMenuRol);
                            $idmenu = $menurol[0]->getIdMenu()->getIdMenu();
                            // Obtenemos los submenus
                            $abmMenus = new AbmMenu;
                            $unMenu = array();
                            $unMenu['idpadre'] = $idmenu;
                            $menus = $abmMenus->buscar($unMenu);
                            if (isset($_POST["selectRol"])) {
                                $selectRol = $_POST["selectRol"];
                                if ((count($menus) > 0) && ($idmenu == $selectRol)) {
                                    echo "<div class='dropdown-divider'></div>";
                                }
                                foreach ($menus as $subMenu) {
                                    $nombreSubMenu = $subMenu->getMeNombre();
                                    $padreSubMenu = $subMenu->getIdPadre();
                                    $rutaSubMenu = $subMenu->getMeDescripcion();

                                    if ($padreSubMenu == $selectRol) {
                                        echo "<a id='" . $padreSubMenu . "' class='dropdown-item' href='" . $rutaSubMenu . "'>
                                                " . $nombreSubMenu . "
                                            </a>";
                                    }
                                }
                            }
                        }

                        echo "<div class='dropdown-divider'></div>
                                <a class='dropdown-item logout' href='../../pages/login/cerrarSesion.php'>
                                   <i class='fas fa-sign-out-alt'></i> Cerrar sesión
                                </a>
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
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </symbol>
                </svg>