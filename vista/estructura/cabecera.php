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
            <span class="navbar-brand fw-bold text-uppercase mb-0">CineUge</span>
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../home/home/index.php">
                            <i class="fas fa-home d-lg-none d-xl-none"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../home/home/contacto.php">
                            <i class="fas fa-info-circle d-lg-none d-xl-none"></i>
                            <span>Contacto</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav d-flex">
                    <!-- Icon carrito -->
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages/cliente/carrito.php" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i> <span class="d-lg-none">Carrito</span>
                        </a>
                    </li>
                    <!-- Icon visitante -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Visitante" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-times"></i> <span class="d-lg-none">Usuario</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Visitante">
                            <a class="dropdown-item" href="../../pages/login/login.php"><span class="fas fa-sign-in-alt fa-fw" aria-hidden="true" title="Log in"></span> Login</a>
                            <a class="dropdown-item" href="../../pages/login/registrar.php"><span class="fas fa-pencil-alt fa-fw" aria-hidden="true" title="Sign up"></span> Registrarse</a>
                        </div>
                    </li>
                    <!-- Icon usuario -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown-Usuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <span class="d-lg-none">Usuario</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-Usuario">
                            <a class="dropdown-item" href="../../pages/perfil/perfil.php">
                                <span class="fas fa-user fa-fw" aria-hidden="true" title="Perfil"></span> Perfil
                            </a>
                            <a class="dropdown-item" href="../../pages/perfil/configuraciones.php"><span class="fas fa-cog fa-fw " aria-hidden="true" title="Configuración"></span> Configuración</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item logout" href="../../pages/login/cerrarSesion.php"><span class="fas fa-sign-out-alt fa-fw" aria-hidden="true" title="Cerrar sesión"></span> Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="mx-auto my-5 px-md-5">
                <?php
                include_once '../../../configuracion.php';
                ?>