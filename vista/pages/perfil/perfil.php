<?php
include_once '../../../configuracion.php';

$sesion = new Session();
$datos = data_submitted();

if (!$sesion->activa()) {
    header('Location: ../../pages/login/login.php');
} else {
    list($sesionValidar, $error) = $sesion->validar();
    if ($sesionValidar) {
        $user = $sesion->getidUser();
        $objAbmUsuario = new AbmUsuario();
        $filtro = array();
        $filtro['idusuario'] = $user;
        $unUsuario = $objAbmUsuario->buscar($filtro);
        // Info usuario
        $id = $unUsuario[0]->getidusuario();
        $nombre = $unUsuario[0]->getusnombre();
        $mail = $unUsuario[0]->getusmail();
        //$usdeshabilitado = $unUsuario[0]->getusdeshabilitado();

        $Titulo = "Perfil de " . $nombre;
        include_once '../../estructura/cabecera.php';
    } else {
        header('Location: ../../pages/login/cerrarSesion.php');
    }
}

?>

<div class="row my-5">
    <form class="mb-5" id="perfilUser" name="perfilUser" method="POST" action="../../pages/login/cerrarSesion.php">
        <div class="d-flex justify-content-center">
            <div id="perfilUser" class='card text-center border border-3'>
                <div class='card-body my-3'>
                    <?php
                    echo "<input class='d-none' id='idusuario' name='idusuario' type='hidden' value='" . $id . "'>";
                    echo "<h3 class='card-title'>BIENVENID@ <br>" . $nombre . "</h3>";
                    echo "Email: $mail" . "<br>";
                    echo "<div class='text-center'>
                            <img alt='homer' class='mb-2 w-50' src='../../img/logoPerfil.png'>
                        </div>";
                    ?>
                    <div class="d-grid gap-2 mx-5">
                        <button href='#' class='btn btn-success' id='editarPerfil' name='editarPerfil' type='submit' formaction='editar.php' value='editarPerfil'><i class='fa fa-pen'></i> Editar Perfil</button>
                        <button href='#' class='btn btn-primary' id='cerrarSesion' name='cerrarSesion' type='submit' value='cerrarSesion'><i class='fas fa-sign-out-alt'></i> Cerrar sesión</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<?php
include_once("../../estructura/pie.php");
?>