<?php
$Titulo = "Editar Usuario";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$objAbmUsuario = new AbmCompra();
$filtro = array();
$filtro['idusuario'] = $datos['accion'];
$userEdit = $objAbmUsuario->buscar($filtro);

$abmUserEditRol = new AbmUsuarioRol;
$idRolUserEdit = $abmUserEditRol->buscarRolesUsuario($userEdit[0]);

$encuentraRol = false;

if ($sesion->activa()) {
    foreach ($idrol as $unIdRol) {
        if ($unIdRol  == 1) {
            $encuentraRol = true;
        }
    }
}

if ($encuentraRol) {
?>

    <!-- Botones -->
    <div class="mb-4">
        <a class="btn btn-dark" href="../../pages/usuario/listar.php" role="button"><i class="fas fa-angle-double-left"></i> Regresar</a>
    </div>

    <section class="content p-3">
        <h2 class="h2 mb-3 text-center">Editar Usuario</h2>

        <form id="editar" name="editar" method="POST" action="abmUsuario.php" data-toggle="validator">
            <div class="form-signin mx-auto">
                <?php
                $id = $userEdit[0]->getidusuario();
                $nombre = $userEdit[0]->getusnombre();
                $mail = $userEdit[0]->getusmail();
                $usdeshabilitado = $userEdit[0]->getusdeshabilitado();

                echo '<input id="idusuario" name="idusuario" value="' . $id . '" type="hidden">';

                echo "<!-- Nombre--> 
                    <div class='mb-3'>
                        <label for='Nombre' class='control-label'>Nombre</label>
                        <input type='text' class='form-control' name='usnombre' id='usnombre' value='$nombre'>
                    </div>
                    <!-- Contrasenia -->
                    <div class='mb-3'>
                        <label for='Contrasenia'>Contraseña</label>
                        <input type='password' class='form-control' name='uspass' id='uspass' placeholder='******'>
                    </div>
                    <!-- Mail -->
                    <div class='mb-3'>
                        <label for='mail'>Mail</label>
                        <input type='email' class='form-control' name='usmail' id='usmail' value='$mail'>
                    </div>
                    <!-- Habilitado -->
                    <div class='mb-3'>
                        <label for='Duenio'>Habilitado</label> 
                        <input type='date' class='form-control' id='usdeshabilitado' name='usdeshabilitado'>
                    </div>";

                ?>

                <!-- Rol -->
                <div class="col mb-5">
                    <?php
                    $rol = new AbmRol();
                    $objRoles = $rol->buscar(null);
                    $bandera = false;
                    foreach ($objRoles as $unObjeto) {
                        $encontro = false;
                        $idUnObjeto = $unObjeto->getidrol();
                        for ($i = 0; $i < count($idRolUserEdit); $i++) {
                            if ($idRolUserEdit[$i] == $idUnObjeto) {
                                $encontro = true;
                            }
                        }
                        if ($encontro) {
                            echo "<div class='form-check form-switch form-check-inline'>
                                <input class='form-check-input' type='checkbox' id='nuevoRol' name='nuevoRol[]' value='" . $unObjeto->getidrol() . "' checked>
                                <label class='form-check-label' for='nuevoRol'>" . $unObjeto->getroldescripcion() . "</label>
                            </div>";
                            $bandera = true;
                        } else {
                            echo  "<div class='form-check form-switch form-check-inline'>
                                <input class='form-check-input' type='checkbox' id='nuevoRol' name='nuevoRol[]' value='" . $unObjeto->getidrol() . "'>
                                <label class='form-check-label' for='nuevoRol'>" . $unObjeto->getroldescripcion() . "</label>
                            </div>";
                        }
                    }
                    if (!$bandera) {
                        echo "<input id='nuevoRol' name='nuevoRol' value='null' type='hidden'>";
                    }
                    ?>

                </div>
                <!-----------ESTO SE ENVIARIA A UNA ACCION Y DE AHI AL ABMUSUARIO------------------->

                <!-- accion = nuevo (input oculto) -->
                <input id="accion" name="accion" value="editar" type="hidden">
                <!-- Botón enviar -->
                <div class="text-center mt-3 mb-5">
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