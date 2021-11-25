<?php
include_once '../../../configuracion.php';
$sesion = new Session();
$datos = data_submitted();

$encuentraRol = false;

if (!$sesion->activa()) {
    header('Location: ../../pages/login/login.php');
} else {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
        $encuentraRol = true;
        $objAbmUsuario = new AbmUsuario();
        $filtro = array();
        $filtro['idusuario'] = $datos['idusuario'];
        $userEdit = $objAbmUsuario->buscar($filtro);

        $id = $userEdit[0]->getidusuario();
        $nombre = $userEdit[0]->getusnombre();
        $mail = $userEdit[0]->getusmail();
        $usdeshabilitado = $userEdit[0]->getusdeshabilitado();

        $Titulo = "Editar Perfil";
        include_once '../../estructura/cabecera.php';
    } else {
        header('Location: ../../pages/login/cerrarSesion.php');
    }
}

if ($encuentraRol) {
?>

    <!-- Botones -->
    <div class="mb-4">
        <a class="btn btn-dark" href="perfil.php" role="button"><i class="fas fa-angle-double-left"></i> Regresar</a>
    </div>

    <section class="content p-3">
        <h2 class="h2 mb-3 text-center">Editar Perfil</h2>

        <form id="editar" name="editar" method="POST" action="../../pages/usuario/abmUsuario.php" data-toggle="validator">
            <div class="form-signin mx-auto">
                <?php

                echo '<input id="idusuario" name="idusuario" value="' . $id . '" type="hidden">';

                echo "<!-- Nombre--> 
                    <div class='mb-3'>
                        <label for='Nombre' class='control-label'>Nombre</label>
                        <input type='text' class='form-control' name='usnombre' id='usnombre' value='$nombre'>
                    </div>
                    <!-- Contraseña -->
                    <div class='mb-3'>
                        <label for='Contrasenia'>Contraseña</label>
                        <input type='password' class='form-control' name='uspass' id='uspass' placeholder='********'>
                    </div>
                    <!-- Mail -->
                    <div class='mb-3'>
                        <label for='mail'>Mail</label>
                        <input type='email' class='form-control' name='usmail' id='usmail' value='$mail'>
                    </div>
                    <!-- Habilitado -->";
                echo '<input id="usdeshabilitado" name="usdeshabilitado" value="' . $usdeshabilitado . '" type="hidden">';
                ?>

                <!-----------ESTO SE ENVIARIA A UNA ACCION Y DE AHI AL ABMUSUARIO------------------->

                <!-- accion = nuevo (input oculto) -->
                <input id="accion" name="accion" value="editarPerfil" type="hidden">
                <!-- Botón enviar -->
                <div class="text-center mt-5 mb-5">
                    <input class="btn btn-danger btn-lg" type="reset" value="Limpiar">
                    <input class="btn btn-primary btn-lg" type="submit" value="Enviar">
                </div>
            </div>
        </form>
    </section>

<?php
} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>