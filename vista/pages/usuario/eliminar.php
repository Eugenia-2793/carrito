<?php
$Titulo = "Eliminar Usuario";
include_once("../../estructura/cabecera.php");

$datos = data_submitted();
$objAbmUsuario = new AbmUsuario();
$filtro = array();
$filtro['idusuario'] = $datos['idusuario'];
$listaUsers = $objAbmUsuario->buscar($filtro);
$unUser = $listaUsers[0];
$id = $unUser->getidusuario();

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

    <section>
        <div class="row my-5">
            <form class="mb-5" id="eliminarUsuario" method="POST" action="abmUsuario.php">
                <div class="d-flex justify-content-center">
                    <?php
                    echo "<input class='d-none' id='idusuario' name='idusuario' type='hidden' value='" . $id . "'>";
                    echo "<div class='card text-center border border-3 border-primary' style='width: 25rem;'>
                <div class='card-body'>
                    <h4 class='card-title'>¡Atención!</h4>
                    <p class='card-text'>¿Realmente desea eliminar este usuario?</p>
                    <button href='#' class='btn btn-primary' id='accion' name='accion' type='submit' value='borrar' style='width: 3rem;'>Sí</button>
                    <button href='#' class='btn btn-primary' id='accion' name='accion' type='submit' value='noAccion' style='width: 3rem;'>No</button>
                </div>
            </div>";
                    ?>
                </div>
            </form>
        </div>
    </section>

<?php
} else {
    include_once("../../pages/login/sinPermiso.php");
}


include_once("../../estructura/pie.php");
?>